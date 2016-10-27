<?php
namespace RudyMas\HTML5;

/**
*	class Menu (Version PHP7)
*
*	This class is an extention of the HTML5 class.
*	You can use this class to create a menu for you. (Max. 5 sub-menus deep)
*
*	$menu = new Menu($maxMenuItems);
*		$maxMenuItems = The number of menu items allowed. (Default = 15)
*
* @author		Rudy Mas <rudy.mas@rudymas.be>
* @copyright	2016, rudymas.be. (http://www.rudymas.be/)
* @license		https://opensource.org/licenses/GPL-3.0 GNU General Public License, version 3 (GPL-3.0)
* @version		1.0.0
*/
class Menu extends HTML5
{
	private $output;
	private $dataMenu = [];
	private $aantalMenuItems;

    /**
     * Menu constructor.
     * @param int $maxMenuItems
     */
    public function __construct($maxMenuItems = 15)
	{
        parent::__construct();
		$this->aantalMenuItems = $maxMenuItems;
	}

    /**
     * Private function to open the nav tag with optional paramaters
     *
     * @param string $id
     * @param string $class
     * @param string|array $attributes
     */
    private function openNav($id = '', $class = '', $attributes = '')
	{
		$this->output = $this->nav('open', $id, $class, $attributes);
	}

    /**
     * Private function to close the nav-tag
     */
    private function closeNav()
	{
		$this->output.= $this->nav('close');
	}

    /**
     * Private function to create the menu with optional parameters
     *
     * @param string $arrayMenu
     * @param string $id
     * @param string $class
     * @param string|array $attributes
     */
	private function createList($arrayMenu = '', $id = '', $class = '', $attributes = '')
	{
		if ($arrayMenu == '') $arrayMenu = $this->dataMenu;
		$remove = array ('geen', 'Geen');
		
		$arrayKey = array_keys($arrayMenu);
		$arrayKey = array_diff($arrayKey, $remove);
		$arrayKey = array_values($arrayKey);
		$arrayCount = count($arrayKey);
		
		$this->output.= $this->ul('open', $id, $class, $attributes);
		if ($arrayCount > $this->aantalMenuItems)
		{
			$aantalExtraMenu = ceil($arrayCount / $this->aantalMenuItems);
			for ($x = 0; $x < $aantalExtraMenu; $x++)
			{
				$this->output.= $this->li('open');
				$this->output.= $this->a('full', '', 'extraMenu', '', '', '&lt; '.($x+1).' &gt;');
				$this->output.= $this->ul('open', '', 'extraMenu');
				for ($y = $x * $this->aantalMenuItems; $y < $this->aantalMenuItems + ($this->aantalMenuItems * $x) && $y < $arrayCount; $y++)
				{
					list ($_url, $_id, $_class, $_attrib) = $this->getURL($arrayMenu[$arrayKey[$y]], $arrayKey[$y]);
					$this->output.= $this->li('open');
					$this->output.= $this->a('full', $_id, $_class, $_attrib, $_url, $arrayKey[$y]);
					$testArray = is_array($arrayMenu[$arrayKey[$y]]);
					if ($testArray === TRUE)
					{
						$arrayKeyChild = array_keys($arrayMenu[$arrayKey[$y]]);
						$arrayKeyChild = array_diff($arrayKeyChild, $remove);
						$arrayCountChild = count($arrayKeyChild);
						if ($arrayCountChild > 0)
						{
							$this->output.= $this->createList($arrayMenu[$arrayKey[$y]]);
						}
					}
					$this->output.= $this->li('close');
				}
				$this->output.= $this->ul('close');
				$this->output.= $this->li('close');
			}
		}
		else
		{
			foreach ($arrayKey as $menuItem)
			{
				list ($_url, $_id, $_class, $_attrib) = $this->getURL($arrayMenu[$menuItem], $menuItem);
				$this->output.= $this->li('open');
				$this->output.= $this->a('full', $_id, $_class, $_attrib, $_url, $menuItem);
				$testArray = is_array($arrayMenu[$menuItem]);
				if ($testArray === TRUE)
				{
					$arrayKeyChild = array_keys($arrayMenu[$menuItem]);
					$arrayKeyChild = array_diff($arrayKeyChild, $remove);
					$arrayCountChild = count($arrayKeyChild);
					if ($arrayCountChild > 0)
					{
						$this->output.= $this->createList($arrayMenu[$menuItem]);
					}
				}
				$this->output.= $this->li('close');
			}
		}
		$this->output.= $this->ul('close');
	}

    /**
     * Private function to get the URL linked with the menu item
     *
     * @param array $array
     * @param string $key
     * @return array
     */
	private function getURL($array, $key)
	{
		$countArray = $this->array_depth($array)-1;
		switch ($countArray)
		{
			case 1:
				$url = $array['geen']['url'];
				$id = $array['geen']['id'];
				$class = $array['geen']['class'];
				$attrib = $array['geen']['attrib'];
				return [$url, $id, $class, $attrib];
			case 2:
				$url = $array['geen']['geen']['url'];
				$id = $array['geen']['geen']['id'];
				$class = $array['geen']['geen']['class'];
				$attrib = $array['geen']['geen']['attrib'];
				return [$url, $id, $class, $attrib];
			case 3:
				$url = $array['geen']['geen']['geen']['url'];
				$id = $array['geen']['geen']['geen']['id'];
				$class = $array['geen']['geen']['geen']['class'];
				$attrib = $array['geen']['geen']['geen']['attrib'];
				return [$url, $id, $class, $attrib];
			case 4:
				$url = $array['geen']['geen']['geen']['geen']['url'];
				$id = $array['geen']['geen']['geen']['geen']['id'];
				$class = $array['geen']['geen']['geen']['geen']['class'];
				$attrib = $array['geen']['geen']['geen']['geen']['attrib'];
				return [$url, $id, $class, $attrib];
			default:
				$url = $array['geen']['geen']['geen']['geen']['geen']['url'];
				$id = $array['geen']['geen']['geen']['geen']['geen']['id'];
				$class = $array['geen']['geen']['geen']['geen']['geen']['class'];
				$attrib = $array['geen']['geen']['geen']['geen']['geen']['attrib'];
				return [$url, $id, $class, $attrib];
		}
	}

    /**
     * To return the created menu
     *
     * @param string $idNav
     * @param string $classNav
     * @param string|array $attributesNav
     * @param string $idList
     * @param string $classList
     * @param string|array $attributesList
     * @return
     */
	public function createMenu($idNav = '', $classNav = '', $attributesNav = '', $idList = '', $classList = '', $attributesList = '')
	{
		$this->openNav($idNav, $classNav, $attributesNav);
		$this->createList('', $idList, $classList, $attributesList);
		$this->closeNav();
		return $this->output;
	}

    /**
     * Adding a menu item
     *
     * @param string $url
     * @param string $id
     * @param string $class
     * @param string|array $attributes
     * @param string $menu1
     * @param string $menu2
     * @param string $menu3
     * @param string $menu4
     * @param string $menu5
     * @param string $menu6
     */
	public function addMenu($url, $id, $class, $attributes, $menu1, $menu2 = 'geen', $menu3 = 'geen', $menu4 = 'geen', $menu5 = 'geen', $menu6 = 'geen')
	{
		$this->dataMenu[$menu1][$menu2][$menu3][$menu4][$menu5][$menu6]['url'] = $url;
		$this->dataMenu[$menu1][$menu2][$menu3][$menu4][$menu5][$menu6]['id'] = $id;
		$this->dataMenu[$menu1][$menu2][$menu3][$menu4][$menu5][$menu6]['class'] = $class;
		$this->dataMenu[$menu1][$menu2][$menu3][$menu4][$menu5][$menu6]['attrib'] = $attributes;
	}

    /**
     * This returns the depth of an array
     *
     * @param array $array
     * @return int
     */
	public function array_depth($array)
	{
		$max_depth = 1;
		foreach ($array as $value)
		{
			if (is_array($value))
			{
				$depth = $this->array_depth($value) + 1;
				if ($depth > $max_depth)
				{
					$max_depth = $depth;
				}
			}
		}
		return $max_depth;
	}
}
/** End of File: Menu.php **/