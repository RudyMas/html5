<?php

namespace RudyMas;

/**
 *    Class HTML5 (Creating a HTML5 page with PHP code)
 *    With this classs, you can create your HTML pages in PHP.
 *    You can easily add ID, CLASS and/or ATTRIBUTES to the tags, and even more specific options
 *    for certain HTML-elements.
 *
 *    !! Make sure that you add the language parameter on the pages which need a doctype !!
 *    Example: $html = new HTML5('nl-BE'); => &lt;doctype html&gt;&lt;html lang="nl-BE"&gt;
 *
 *    When you use "new HTML5" or "new HTML5()" no doctype is added.
 *    This is done, so you can extend this class to other classes.
 *
 * @author      Rudy Mas <rudy.mas@rudymas.be>
 * @copyright   2014-2020, rudymas.be. (http://www.rudymas.be/)
 * @license     https://opensource.org/licenses/GPL-3.0 GNU General Public License, version 3 (GPL-3.0)
 * @version     1.0.1.0
 * @package     RudyMas
 */
class HTML5
{
    /**
     * @var bool
     */
    private $destruct;

    /**
     * HTML5 constructor.
     * Opening a new HTML5 page
     *
     * @param null|string $lang Language type of the HTML page / Example: nl-BE for Dutch Belgium
     *                              !!! Needs to be set to add the doctype !!!
     */
    public function __construct($lang = NULL)
    {
        if ($lang !== NULL) {
            $this->destruct = TRUE;
            $output = sprintf('<!doctype html><html lang="%s">', $lang);
            echo $output;
        } else {
            $this->destruct = FALSE;
        }
    }

    /**
     * Closing the HTML5 page
     */
    public function __destruct()
    {
        if ($this->destruct === TRUE) {
            $output = '</html>';
            echo $output;
        }
    }

    /**
     * Creating the head section of the page
     *
     * The &lt;head&gt; element is a container for all the head elements.
     * The &lt;headagt; element can include a title for the document,
     * scripts, styles, meta information, and more.
     *
     * To make it more easy, the most important meta-tags are automaticly added to the webpage.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     * @param string $title The titel used for &lt;title&gt;
     * @param string $author Name of the author of the website
     * @param string $email Email address people can write to for information
     * @param string $keywords Keywords that can be used by search engines
     * @param string $description Short discription of the function of the website
     * @param string $robots How robots have to look at the website (Default = index,follow)
     * @param string $rating Rating of the contents of the website (Default = General)
     * @param string $charset Character set to be used (Default = utf-8)
     * @return string $output
     */
    public function head
    (
        $action, $title = 'Title Website/Page',
        $author = 'First- Lastname',
        $email = 'name@website.com',
        $keywords = 'keywords, for, search, engine',
        $description = 'Short description website',
        $robots = 'index,follow',
        $rating = 'General',
        $charset = 'utf-8'
    )
    {
        switch (strtolower($action)) {
            case 'open':
            case 'start':
            case 'begin':
                $output = '<head>';
                $output .= $this->meta('full', '', '', '', 'charset', $charset);
                $output .= $this->meta('full', '', '', '', 'http-equiv', 'X-UA-Compatible', 'IE=Edge');
                $output .= $this->meta('full', '', '', '', 'name', 'viewport', 'width=device-width, initial-scale=1');
                $output .= $this->meta('full', '', '', '', 'name', 'revisit-after', '7 days');
                $output .= $this->meta('full', '', '', '', 'name', 'generator', 'PHP code');
                $output .= $this->meta('full', '', '', '', 'name', 'author', $author);
                $output .= $this->meta('full', '', '', '', 'name', 'contact', $email);
                $output .= $this->meta('full', '', '', '', 'name', 'keywords', $keywords);
                $output .= $this->meta('full', '', '', '', 'name', 'description', $description);
                $output .= $this->meta('full', '', '', '', 'name', 'robots', $robots);
                $output .= $this->meta('full', '', '', '', 'name', 'rating', $rating);
                $output .= $this->title('full', '', '', '', $title);
                break;
            case 'close':
            case 'stop':
            case 'end':
                $output = '</head>';
                break;
            default:
                $errorMsg = 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->head($action, $title*, $author*, $email*, $keywords*, $description*, $charset*)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('head');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Adding a CSS-file
     *
     * @param string $file Path to the CSS-file to be used
     * @param string $media On which media the CSS has to be used (Default: all)
     * @return string
     */
    public function addCSS($file, $media = 'all')
    {
        return $this->link('full', '', '', '', $file, $media);
    }

    /**
     * Adding a script-file
     *
     * @param string $file Path to the script-file to be used
     * @param string $type The type of script language that is used (Default: text/javascript)
     * @return string
     */
    public function addScript($file, $type = 'text/javascript')
    {
        return $this->script('full', '', '', '', $file, $type);
    }

    /**
     * Instantly runs a JavaScript
     *
     * @param string $action A script that runs instantly
     * @return string
     */
    public function runJavascript($action)
    {
        return $this->script('full', '', '', '', '', '', $action);
    }

    /**
     * Adding a check for older versions of Internet Explorer (Add this just after opening the body of the page)
     *
     * @param string $lang The language to be used for the warning message (Default: nl)
     * @return string
     */
    public function checkHTML5($lang = 'nl')
    {
        $output = '<!--[if lt IE 9]>';
        $output .= '<script type="text/javascript">document.createElement(\'header\');document.createElement(\'footer\');document.createElement(\'section\');document.createElement(\'aside\');document.createElement(\'nav\');document.createElement(\'article\');</script>';
        $output .= '<style>header, footer, section, aside, nav, article { display: block; }</style>';
        if (!isset($_COOKIE['warningBox'])) {
            $output .= '<script type="text/javascript">function centerBox(boxCenter) { var box = document.getElementById(boxCenter); var availHeight = document.documentElement.clientHeight; var availWidth = document.documentElement.clientWidth; var boxHeight = box.clientHeight; var boxWidth = box.clientWidth; box.style.position = \'absolute\'; box.style.top = ((availHeight - boxHeight) / 2) + \'px\'; box.style.left = ((availWidth - boxWidth) / 2) + \'px\'; }
							function hideBox(elementHide) { var verbergen = document.getElementById(elementHide); verbergen.style.display = \'none\'; var theCookie = "warningBox=true"; document.cookie = theCookie; } </script>';
            $output .= '<style>';
            $output .= '#browser { position:absolute; width:350px; border:2px solid rgb(0,0,0); background-color:rgb(255,255,204); color:rgb(0,0,0); z-index:100; font-size:16px; }';
            $output .= '#browser div.warningTop { background-color:rgb(255,0,0); overflow:hidden; }';
            $output .= '#browser div.warningTop p.floatLeft { float:left; font-weight:bold; padding:1px 0px 1px 10px; font-size:18px; }';
            $output .= '#browser div.warningTop p.floatRight { float:right; border:1px solid rgb(153,153,153); background-color:rgb(255,102,102); }';
            $output .= '#browser div.warningTop p.floatRight a { text-decoration:none; color:rgb(255,255,255); padding:0px 20px; text-align:center; font-family:Arial, Helvetica, sans-serif; }';
            $output .= '#browser div.warningTop p.floatRight a:hover { background-color:rgb(255,204,204); color:rgb(0,0,0); }';
            $output .= '#browser div.warningMessage { clear:both; text-align:justify; padding:5px; border-top:1px solid rgb(0,0,0); }';
            $output .= '#browser div.warningMessage p.centreren { text-align:center; }';
            $output .= '</style>';
            $output .= '<div id="prompt"></div>';
            $output .= '<div id="browser">';
            if ($lang == 'en') {
                $output .= '<div class="warningTop"><p class="floatLeft">BROWSER WARNING</p><p class="floatRight"><a title="Close Window" href="javascript:void(0)" onClick="hideBox(\'browser\')">X</a></p></div>';
                $output .= '<div class="warningMessage"><p>This website was created with HTML5 and CSS3. To avoid problems, you can use Internet Explorer 9+ or the latest version of Firefox or Google Chrome.</p></div>';
            } else {
                $output .= '<div class="warningTop"><p class="floatLeft">BROWSER WAARSCHUWING</p><p class="floatRight"><a title="Sluit Venster" href="javascript:void(0)" onClick="hideBox(\'browser\')">X</a></p></div>';
                $output .= '<div class="warningMessage"><p>Deze website is gemaakt met HTML5 en CSS3. Om geen problemen te ondervinden kun je het beste Internet Explorer 9+ gebruiken of de laatste nieuwe versie van FireFox of Google Chroome.</p></div>';
            }
            $output .= '</div>';
            $output .= '<script type="text/javascript">centerBox(\'browser\');</script>';
        }
        $output .= '<![endif]-->';
        return $output;
    }

    /**
     * Opening and closing the body of the page
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      content that goes between the opening and closing body-tag
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function body($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('body', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add an a-tag
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $url The URL of the page you want to link to
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function a($action, $id = '', $class = '', $attributes = '', $url = '', $input = '')
    {
        switch (strtolower($action)) {
            case 'open':
            case 'start':
            case 'begin':
                $output = '<a';
                if ($url != '') $output .= sprintf(' href="%s"', $url);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            case 'close':
            case 'stop':
            case 'end':
                $output = '</a>';
                break;
            case 'full':
                $output = '<a';
                if ($url != '') $output .= sprintf(' href="%s"', $url);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= sprintf('>%s</a>', $input);
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->a($action, $id*, $class*, $attributes*, $url*, $input*)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('a');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add an abbr-tag
     *
     * @param string $action - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $abbrevation Defines an abbreviation or an acronym, like "Mr.", "Dec.", "ASAP"
     * @param string $explanation The explanation of the abbreviation
     * @return string
     */
    public function abbr($action, $id, $class, $attributes, $abbrevation, $explanation = 'Missing explanation')
    {
        switch (strtolower($action)) {
            case 'full':
                $output = sprintf('<abbr title="%s"', $explanation);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= sprintf('>%s</abbr>', $abbrevation);
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->abbr($action, $id, $class, $attributes, $abbrevation, $explanation)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('abbr');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add an address-tag
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function address($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('address', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add an area-tag
     *
     * @param string $action <i>full</i>: Opens and closes the element, $input is used for the
     *                                    contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $shape Specifies the shape of the area (rect, circle, poly)
     * @param string $coords Specifies the coordinates of the area
     * @param string $url Specifies the hyperlink target for the area
     * @param string $alt Specifies an alternate text for the area. Required if the href attribute is present
     * @return string
     */
    public function area($action, $id, $class, $attributes, $shape, $coords, $url, $alt)
    {
        switch ($action) {
            case 'full':
                $output = sprintf('<area shape="%s" coords="%s" href="%s" alt="%s"', $shape, $coords, $url, $alt);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->area($action, $id, $class, $attributes, $shape, $coords, $url, $alt)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('area');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add an article-tag
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function article($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('article', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add an aside-tag
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function aside($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('aside', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add an audio-tag
     *
     * The &lt;audio&gt; tag defines sound, such as music or other audio streams.
     *
     * How to use this in your code?
     * <i>First you have to create the source to be used, you do this by making an array.</i>'
     * $source = array();
     * $source['audio/mpeg'] = 'your_audio_file.mp3';
     * $source['audio/ogg'] = 'your_audio_file.ogg';
     * $source['audio/wav'] = 'your_audio_file.wav';
     * <i>Then you call the function.</i>
     * echo $html->audio('full', '', '', 'controls', $source, 'Your browser does not support the audio tag.');
     *
     * At the moment, only .mp3, .ogg and .wav are supported. You can add different sources and the browser will use the one it supports.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add (at least set 'controls')
     * @param array $audioSource Link to all sources, this is an array()
     * @param string $input Text to show when not supported (Default: Your browser does not support the audio tag.)
     * @return string
     */
    public function audio($action, $id = '', $class = '', $attributes = '', $audioSource = NULL, $input = 'Your browser does not support the audio tag.')
    {
        switch (strtolower($action)) {
            case 'open':
            case 'start':
            case 'begin':
                $output = '<audio';
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            case 'close':
            case 'stop':
            case 'end':
                $output = $input;
                $output .= '</audio>';
                break;
            case 'full':
                $output = '<audio';
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                foreach ($audioSource as $type => $source) {
                    $output .= sprintf('<source src="%s" type="%s">', $source, $type);
                }
                $output .= $input;
                $output .= '</audio>';
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->audio($action, $id*, $class*, $attributes*, $audioSource*, $input*)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('audio');
                $errorMsg .= 'How to use this in your code?<br>';
                $errorMsg .= '<i>// First you have to create the source to be used, you do this by making an array.</i><br>';
                $errorMsg .= '$source = array();<br>';
                $errorMsg .= "\$source['audio/mpeg'] = 'your_audio_file.mp3';<br>";
                $errorMsg .= "\$source['audio/ogg'] = 'your_audio_file.ogg';<br>";
                $errorMsg .= "\$source['audio/wav'] = 'your_audio_file.wav';<br>";
                $errorMsg .= '<i>// Then you call the function.</i><br>';
                $errorMsg .= 'echo $html->audio(\'full\', \'\', \'\', \'controls\', $source, \'Your browser doesn\'t support the audio tag.\');<br>';
                $errorMsg .= '<br>';
                $errorMsg .= 'At the moment, only .mp3, .ogg and .wav are supported. You can add different sources and the browser will use the one it supports.';
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add a b-tag
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function b($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('b', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a base-tag
     *
     * @param string $action - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $url Specifies the base URL for all relative URLs in the page
     * @param string $target Specifies the default target for all hyperlinks and forms in the page
     *                       (Options: _blank, _parent, _self, _top / Default: _self)
     * @return string
     */
    public function base($action, $id, $class, $attributes, $url, $target = '_self')
    {
        switch (strtolower($action)) {
            case 'full':
                $output = sprintf('<base href="%s" target="%s"', $url, $target);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->base($action, $id, $class, $attributes, $url, $target*)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('base');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add a bdi-tag
     *
     * bdi stands for Bi-Directional Isolation.
     * The &lt;bdi&gt; tag isolates a part of text that might be formatted in a different direction from other text outside it.
     * This element is useful when embedding user-generated content with an unknown directionality.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string <bm>
     */
    public function bdi($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('bdi', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a bdo-tag
     *
     * bdo stands for Bi-Directional Override.
     * The &lt;bdo&gt; tag is used to override the current text direction.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $dir Required. Specifies the text direction of the text inside the <bdo> element
     *                      (ltr => Left to Right, rtl => Right to Left / Default = ltr)
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function bdo($action, $id = '', $class = '', $attributes = '', $dir = 'ltr', $input = '')
    {
        if (!($dir == 'ltr' or $dir == 'rtl')) $dir = 'ltr';
        switch (strtolower($action)) {
            case 'open':
            case 'start':
            case 'begin':
                $output = sprintf('<bdo dir="%s"', $dir);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            case 'close':
            case 'stop':
            case 'end':
                $output = '</bdo>';
                break;
            case 'full':
                $output = sprintf('<bdo dir="%s"', $dir);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= sprintf('>%s</bdo>', $input);
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->bdo($action, $id*, $class*, $attributes*, $dir*, $input*)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('base');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add a blockquote-tag
     *
     * The &lt;blockquote&gt; tag specifies a section that is quoted from another source.
     * Browsers usually indent &lt;blockquote&gt; elements.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $cite Specifies the source of the quotation
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function blockquote($action, $id = '', $class = '', $attributes = '', $cite = '', $input = '')
    {
        switch (strtolower($action)) {
            case 'open':
            case 'start':
            case 'begin':
                $output = '<blockquote';
                if ($cite != '') sprintf(' cite="%s"', $cite);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            case 'close':
            case 'stop':
            case 'end':
                $output = '</blockquote>';
                break;
            case 'full':
                $output = '<blockquote';
                if ($cite != '') sprintf(' cite="%s"', $cite);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= sprintf('>%s</blockquote>', $input);
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->blockquote($action, $id*, $class*, $attributes*, $cite*, $input*)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('blockquote');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add a br-tag
     *
     * @param string $action - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @return string
     */
    public function br($action, $id = '', $class = '', $attributes = '')
    {
        switch (strtolower($action)) {
            case 'full':
                $output = '<br';
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->br($action, $id*, $class*, $attributes*)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('br');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add a button-tag
     *
     * The &lt;button&gt; tag defines a clickable button.
     * Inside a &lt;button&gt; element you can put content, like text or images.
     * This is the difference between this element and buttons created with the &lt;input&gt; element.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function button($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        if ($attributes == '') $attributes = 'type="button"';
        return $this->newTag('button', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a canvas-tag
     *
     * The &lt;canvas&gt; tag is used to draw graphics, on the fly, via scripting (usually JavaScript).
     * The &lt;canvas&gt; tag is only a container for graphics, you must use a script to actually draw the graphics.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element (Default: myCanvas)
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function canvas($action, $id = 'myCanvas', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('canvas', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a caption-tag
     *
     * The &lt;caption&gt; tag defines a table caption.
     * The &lt;caption&gt; tag must be inserted immediately after the <table> tag.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function caption($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('caption', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a cite-tag
     *
     * The &lt;cite&gt; tag defines the title of a work (e.g. a book, a song, a movie, a TV show, a painting, a sculpture, etc.).
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function cite($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('cite', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a code-tag
     *
     * The &lt;code&gt; tag is a phrase tag. It defines a piece of computer code.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function code($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('code', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a col-tag
     *
     * The &lt;col&gt; tag specifies column properties for each column within a &lt;colgroup&gt; element.
     * The &lt;col&gt; tag is useful for applying styles to entire columns,
     * instead of repeating the styles for each cell, for each row.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $span Specifies the number of columns a &lt;col&gt; element should span
     * @return string
     */
    public function col($action, $id = '', $class = '', $attributes = '', $span = '')
    {
        switch (strtolower($action)) {
            case 'full':
                $output = '<col';
                if ($span != '') $output .= sprintf(' span="%s"', $span);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->col($action, $id*, $class*, $attributes*, $span*)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('col');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add a colgroup-tag
     *
     * The &lt;colgroup&gt; tag specifies a group of one or more columns in a table for formatting.
     * The &lt;colgroup&gt; tag is useful for applying styles to entire columns,
     * instead of repeating the styles for each cell, for each row.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $span Specifies the number of columns a column group should span
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function colgroup($action, $id = '', $class = '', $attributes = '', $span = '', $input = '')
    {
        switch (strtolower($action)) {
            case 'open':
            case 'start':
            case 'begin':
                $output = '<colgroup';
                if ($span != '') $output .= sprintf(' span="%s"', $span);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            case 'close':
            case 'stop':
            case 'end':
                $output = '</colgroup>';
                break;
            case 'full':
                $output = '<colgroup';
                if ($span != '') $output .= sprintf(' span="%s"', $span);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= sprintf('>%s</colgroup>', $input);
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->blockquote($action, $id*, $class*, $attributes*, $span*, $input*)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('colgroup');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add a datalist-tag (included options)
     *
     * The &lt;datalist&gt; tag specifies a list of pre-defined options for an &lt;input&gt; element.
     * The &lt;datalist&gt; tag is used to provide an "autocomplete" feature on &lt;input&gt; elements.
     * Users will see a drop-down list of pre-defined options as they input data.
     * Use the &lt;input&gt; element's list attribute to bind it together with a &lt;datalist&gt; element.
     *
     * How to use this in your code?
     * <i>First you have to create a list of options, you do this by making an array.</i>
     * $list = array();
     * $list[] = 'Option 1';
     * $list[] = 'Option 2';
     * $list[] = 'Option 3';
     * <i>Then you call the function.</i>
     * echo $html->datalist('full', 'nameList', '[class is optional]', '[attributes are optional]', $list);
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element (input list uses this as a referance)
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param array $options A list of options that will be shown by an input element
     * @return string
     */
    public function datalist($action, $id, $class = '', $attributes = '', $options = NULL)
    {
        switch (strtolower($action)) {
            case 'open':
            case 'start':
            case 'begin':
                $output = '<datalist';
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            case 'close':
            case 'stop':
            case 'end':
                $output = '</datalist>';
                break;
            case 'full':
                $output = '<datalist';
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                foreach ($options as $option) {
                    $output .= sprintf('<option value="%s">', $option);
                }
                $output .= '</datalist>';
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->datalist($action, $id, $class*, $attributes*, $options*)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('datalist');
                $errorMsg .= '<br>How to use this in your code?<br>';
                $errorMsg .= '<i>// First you have to create a list of options, you do this by making an array.</i><br>';
                $errorMsg .= '$list = array();<br>';
                $errorMsg .= "\$list[] = 'Option 1';<br>";
                $errorMsg .= "\$list[] = 'Option 2';<br>";
                $errorMsg .= "\$list[] = 'Option 3';<br>";
                $errorMsg .= '<i>// Then you call the function.</i><br>';
                $errorMsg .= 'echo $html->datalist(\'full\', \'testList\', \'[class is optional]\', \'[attributes are optional]\', $list);<br>';
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add a dl-tag
     *
     * The &lt;dl&gt; tag defines a description list.
     * The &lt;dl&gt; tag is used in conjunction with &lt;dt&gt; (defines terms/names)
     * and &lt;dd&gt; (describes each term/name).
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function dl($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('dl', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a dt-tag
     *
     * The &lt;dt&gt; tag defines a term/name in a description list.
     * The &lt;dt&gt; tag is used in conjunction with &lt;dl&gt; (defines a description list)
     * and &lt;dd&gt; (describes each term/name).
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function dt($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('dt', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a dd-tag
     *
     * The &lt;dd&gt; tag is used to describe a term/name in a description list.
     * The &lt;dd&gt; tag is used in conjunction with &lt;dl&gt; (defines a description list)
     * and &lt;dt&gt; (defines terms/names).
     * Inside a &lt;dd&gt; tag you can put paragraphs, line breaks, images, links, lists, etc.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function dd($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('dd', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a del-tag
     *
     * The &lt;del&gt; tag defines text that has been deleted from a document.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function del($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('del', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a details-tag
     *
     * The &lt;details&gt; tag specifies additional details that the user can view or hide on demand.
     * The &lt;details&gt; tag can be used to create an interactive widget that the user can open and close.
     * Any sort of content can be put inside the &lt;details&gt; tag.
     * The content of a &lt;details&gt; element should not be visible unless the open attribute is set.
     *
     * <b>Tip:</b> The &lt;summary&gt; tag is used to specify a visible heading for the details.
     * The heading can be clicked to view/hide the details.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function details($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('details', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a dfn-tag
     *
     * The &lt;dfn&gt; tag represents the defining instance of a term in HTML.
     * The defining instance is often the first use of a term in a document.
     * The nearest parent of the &lt;dfn&gt; tag must also contain the
     * definition/explanation for the term inside &lt;dfn&gt;.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function dfn($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('dfn', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a dialog-tag
     *
     * The &lt;dialog&gt; tag defines a dialog box or window.
     * The &lt;dialog&gt; element makes it easy to create popup
     * dialogs and modals on a web page.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function dialog($action, $id = '', $class = '', $attributes = 'open', $input = '')
    {
        return $this->newTag('dialog', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a div-tag
     *
     * The &lt;div&gt; tag defines a division or a section in an HTML document.
     * The &lt;div&gt; tag is used to group block-elements to format them with CSS.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function div($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('div', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a em-tag
     *
     * The &lt;em&gt; tag is a phrase tag. It renders as emphasized text.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function em($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('em', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a embed-tag
     *
     * The &lt;embed<gt; tag defines a container for an external application or interactive content (a plug-in).
     *
     * @param string $action - <i>full</i>: Opens and closes the element
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $src Specifies the address of the external file to embed
     * @param string $type Specifies the media type of the embedded content
     * @param int $width Specifies the width of the embedded content
     * @param int $height Specifies the height of the embedded content
     * @return string
     */
    public function embed($action, $id, $class, $attributes, $src, $type = '', $width = 0, $height = 0)
    {
        switch (strtolower($action)) {
            case 'full':
                $output = sprintf('<embed src="%s"', $src);
                $output .= $this->addExtras($id, $class, $attributes);
                if ($type != '') $output .= sprintf(' type="%s"', $type);
                if ($width != 0) $output .= sprintf(' width=%d', $width);
                if ($height != 0) $output .= sprintf(' height=%d', $height);
                $output .= '>';
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->embed($action, $id, $class, $attributes, $src, $type*, $width*, $height*)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('embed');
                $errorMsg .= 'Extra information about the media types can be found ' . $this->a('full', '', '', 'target="_blank"', 'http://www.iana.org/assignments/media-types/media-types.xhtml', '>here<') . '.';
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add a fieldset-tag
     *
     * The &lt;fieldset&gt; tag is used to group related elements in a form.
     * The &lt;fieldset&gt; tag draws a box around the related elements.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function fieldset($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('fieldset', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a figcaption-tag
     *
     * The &lt;figcaption&gt; tag defines a caption for a &lt;figure&gt; element.
     * The &lt;figcaption&gt; element can be placed as the first or last child of the &lt;figure&gt; element.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function figcaption($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('figcaption', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a figure-tag
     *
     * The &lt;figure&gt; tag specifies self-contained content, like illustrations,
     * diagrams, photos, code listings, etc.
     * While the content of the &lt;figure&gt; element is related to the main flow,
     * its position is independent of the main flow, and if removed it should not
     * affect the flow of the document.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function figure($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('figure', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a footer-tag
     *
     * The &lt;footer&gt; tag defines a footer for a document or section.
     * A &lt;footer&gt; element should contain information about its containing element.
     * You can have several &lt;footer&gt; elements in one document.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function footer($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('footer', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a form-tag
     *
     * The &lt;form&gt; tag is used to create an HTML form for user input.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $sendTo Specifies where to send the form-data when a form is submitted
     * @param string $method Specifies the HTTP method to use when sending form-data (Default: post);
     * @param string $name Specifies the name of a form
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function form($action, $id = '', $class = '', $attributes = '', $sendTo = '', $method = 'post', $name = '', $input = '')
    {
        switch (strtolower($action)) {
            case 'open':
            case 'start':
            case 'begin':
                $output = sprintf('<form action="%s"', $sendTo);
                if ($method != '') $output .= sprintf(' method="%s"', $method);
                if ($name != '') $output .= sprintf(' name="%s"', $name);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            case 'close':
            case 'stop':
            case 'end':
                $output = '</form>';
                break;
            case 'full':
                $output = sprintf('<form action="%s"', $sendTo);
                if ($method != '') $output .= sprintf(' method="%s"', $method);
                if ($name != '') $output .= sprintf(' name="%s"', $name);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= sprintf('>%s</form>', $input);
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->form($action, $id*, $class*, $attributes*, $sendTo*, $method*, $name*, $input*)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= '$method is by default \'post\'';
                $errorMsg .= $this->w3schoolsAttr('form');
                $errorMsg .= '<ul><b>$input:</b> [Optional]';
                $errorMsg .= '<li>All the input-tags and extra information you want to show.<br>';
                $errorMsg .= 'If you don\'t have attributes to add, you need to use it as followed:<br>';
                $errorMsg .= "\$input = [Put all the information for the form in a string]<br>";
                $errorMsg .= "className->form('full', '', '', '', 'verwerk.php', 'post', 'nameForm', \$input)<br></li>";
                $errorMsg .= ('</ul>');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add a h1-tag
     *
     * The &lt;h1&gt; to &lt;h6&gt; tags are used to define HTML headings.
     * &lt;h1&gt; defines the most important heading. &lt;h6&gt; defines the least important heading.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function h1($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('h1', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a h2-tag
     *
     * The &lt;h1&gt; to &lt;h6&gt; tags are used to define HTML headings.
     * &lt;h1&gt; defines the most important heading. &lt;h6&gt; defines the least important heading.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function h2($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('h2', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a h3-tag
     *
     * The &lt;h1&gt; to &lt;h6&gt; tags are used to define HTML headings.
     * &lt;h1&gt; defines the most important heading. &lt;h6&gt; defines the least important heading.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function h3($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('h3', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a h4-tag
     *
     * The &lt;h1&gt; to &lt;h6&gt; tags are used to define HTML headings.
     * &lt;h1&gt; defines the most important heading. &lt;h6&gt; defines the least important heading.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function h4($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('h4', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a h5-tag
     *
     * The &lt;h1&gt; to &lt;h6&gt; tags are used to define HTML headings.
     * &lt;h1&gt; defines the most important heading. &lt;h6&gt; defines the least important heading.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function h5($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('h5', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a h6-tag
     *
     * The &lt;h1&gt; to &lt;h6&gt; tags are used to define HTML headings.
     * &lt;h1&gt; defines the most important heading. &lt;h6&gt; defines the least important heading.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function h6($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('h6', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a header-tag
     *
     * The &lt;header&gt; element represents a container for introductory content or a set of navigational links.
     * You can have several &lt;header&gt; elements in one document.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function header($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('header', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a hr-tag
     *
     * The &lt;hr&gt; tag defines a thematic break in an HTML page (e.g. a shift of topic).
     * The &lt;hr&gt; element is used to separate content (or define a change) in an HTML page.
     *
     * @param string $action - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @return string
     */
    public function hr($action, $id = '', $class = '', $attributes = '')
    {
        switch (strtolower($action)) {
            case 'full':
                $output = '<hr';
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->hr($action, $id*, $class*, $attributes*)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('hr');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add a i-tag
     *
     * The &lt;i&gt; tag defines a part of text in an alternate voice or mood.
     * The content of the alt;iagt; tag is usually displayed in italic.
     * The &lt;i&gt; tag can be used to indicate a technical term,
     * a phrase from another language, a thought, or a ship name, etc.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function i($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('i', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a iframe-tag
     *
     * The &lt;iframe&gt; tag specifies an inline frame.
     * An inline frame is used to embed another document within the current HTML document.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $src Specifies the URL of an image
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function iframe($action, $id, $class, $attributes, $src, $input = '')
    {
        switch (strtolower($action)) {
            case 'open':
            case 'start':
            case 'begin':
                $output = sprintf('<iframe src="%s"', $src);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            case 'close':
            case 'stop':
            case 'end':
                $output = '</iframe>';
                break;
            case 'full':
                $output = sprintf('<iframe src="%s"', $src);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= sprintf('>%s</iframe>', $input);
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->iframe($action, $id, $class, $attributes, $src, $input*)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('iframe');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add a img-tag
     *
     * The &lt;img&gt; tag defines an image in an HTML page.
     * The &lt;img&gt; tag has two required attributes: src and alt.
     *
     * @param string $action - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $src Specifies the URL of an image
     * @param string $alt Specifies an alternate text for an image
     * @param int $width Specifies the width of an image
     * @param int $height Specifies the height of an image
     * @return string
     */
    public function img($action, $id, $class, $attributes, $src, $alt = 'no alternate text', $width = 0, $height = 0)
    {
        switch (strtolower($action)) {
            case 'full':
                $output = sprintf('<img src="%s" alt="%s"', $src, $alt);
                $output .= $this->addExtras($id, $class, $attributes);
                if ($width != 0) $output .= sprintf(' width=%d', $width);
                if ($height != 0) $output .= sprintf(' height=%d', $height);
                $output .= '>';
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->img($action, $id, $class, $attributes, $src, $alt, $width*, $height*)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('img');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add an input-tag
     *
     * The &lt;input&gt; tag specifies an input field where the user can enter data.
     * &lt;input&gt; elements are used within a &lt;form&gt; element to declare
     * input controls that allow users to input data.
     * An input field can vary in many ways, depending on the type attribute.
     *
     * @param string $action - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $type Specifies the type &lt;input&gt; element to display
     * @param string $name Specifies the name of an &lt;input&gt; element
     * @param string $value Specifies the value of an &lt;input&gt; element
     * @return string
     */
    public function input($action, $id, $class, $attributes, $type, $name = '', $value = '')
    {
        switch (strtolower($action)) {
            case 'full':
                $output = sprintf('<input type="%s"', $type);
                $output .= $this->addExtras($id, $class, $attributes);
                if ($name != '') $output .= sprintf(' name="%s"', $name);
                if ($value != '') $output .= sprintf(' value="%s"', $value);
                $output .= '>';
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->input($action, $id, $class, $attributes, $type, $name*, $value*)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('input');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add a ins-tag
     *
     * The &lt;ins&gt; tag defines a text that has been inserted into a document.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function ins($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('ins', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a kbd-tag
     *
     * The &lt;kbd&gt; tag is a phrase tag. It defines keyboard input.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function kbd($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('kbd', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a keygen-tag
     *
     * The &lt;keygen&gt; tag specifies a key-pair generator field used for forms.
     * When the form is submitted, the private key is stored locally,
     * and the public key is sent to the server.
     *
     * @param string $action - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $name Defines a name for the &lt;keygen&gt; element
     * @return string
     */
    public function keygen($action, $id, $class, $attributes, $name)
    {
        switch (strtolower($action)) {
            case 'full':
                $output = sprintf('<keygen name="%s"', $name);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->keygen($action, $id, $class, $attributes, $name)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('keygen');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add a label-tag
     *
     * The &lt;labelagt; tag defines a label for an <input> element.
     * The alt;labelagt; element does not render as anything special
     * for the user. However, it provides a usability improvement for
     * mouse users, because if the user clicks on the text within
     * the &lt;labelagt; element, it toggles the control.
     * The for attribute of the &lt;label&gt; tag should be equal to
     * the id attribute of the related element to bind them together.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $for Defines a name for the &lt;keygen&gt; element
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function label($action, $id, $class, $attributes, $for, $input = '')
    {
        switch (strtolower($action)) {
            case 'open':
            case 'start':
            case 'begin':
                $output = sprintf('<label for="%s"', $for);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            case 'close':
            case 'stop':
            case 'end':
                $output = '</label>';
                break;
            case 'full':
                $output = sprintf('<label for="%s"', $for);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= sprintf('>%s</label>', $input);
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->label($action, $id, $class, $attributes, $for, $input*)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('label');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add a legend-tag
     *
     * The &lt;legend&gt; tag defines a caption for the &lt;fieldset&gt; element.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function legend($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('legend', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a li-tag
     *
     * The &lt;li&gt; tag defines a list item.
     * The &lt;liagt; tag is used in ordered lists(alt;olagt;),
     * unordered lists (&lt;ulagt;), and in menu lists (&lt;menu&gt;).
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function li($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('li', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a link-tag
     *
     * The &lt;linkagt; tag defines a link between a document and an external resource.
     * The &lt;link&gt; tag is used to link to external style sheets.
     *
     * @param string $action - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $href Specifies the location of the linked document
     * @param string $media Specifies on what device the linked document will be displayed (Default = all)
     * @param string $rel Required. Specifies the relationship between the current document and the linked document
     *                      (Default = stylesheet)
     * @param string $type Specifies the media type of the linked document (Default = text/css)
     * @return string
     */
    public function link($action, $id, $class, $attributes, $href, $media = 'all', $rel = 'stylesheet', $type = 'text/css')
    {
        switch (strtolower($action)) {
            case 'full':
                $output = sprintf('<link href="%s" rel="%s" type="%s" media="%s"', $href, $rel, $type, $media);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->link($action, $id, $class, $attributes, $href, $media*, $rel*, $type*)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= '$media -> Default: all';
                $errorMsg .= '$rel -> Default: stylesheet<br>';
                $errorMsg .= '$type -> Default: text/css<br>';
                $errorMsg .= $this->w3schoolsAttr('link');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add a main-tag
     *
     * The &lt;main&gt; tag specifies the main content of a document.
     * The content inside the &lt;main&gt; element should be unique to the document.
     * It should not contain any content that is repeated across documents such as
     * sidebars, navigation links, copyright information, site logos, and search forms.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function main($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('main', $action, $id, $class, $attributes, $input);
    }

    /**
     * use this to add a map-tag
     *
     * The &lt;map&gt; tag is used to define a client-side image-map. An image-map
     * is an image with clickable areas.
     * The required name attribute of the &lt;map&gt; element is associated with
     * the &lt;img&gt;'s usemap attribute and creates a relationship between the image and the map.
     * The &lt;map&gt; element contains a number of &lt;area&gt; elements, that defines
     * the clickable areas in the image map.
     *
     * <ul><b>$input:</b> [Optional]
     * <li>All the area-tags you want to add as a string.
     * If you don't have attributes to add, you need to use it as followed:
     * $string = $htmlClass->area('full', '', '', '', 'rect', '0,0,20,20', 'http://www.link1.be/', 'link1');
     * $string.= $htmlClass->area('full', '', '', '', 'circle', '30,30,10', 'http://www.link2.be/', 'link2');
     * className->map('full', '', '', '', 'imageName', $string)</li></ul>
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $name Required. Specifies the name of an image-map
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function map($action, $id, $class, $attributes, $name, $input = '')
    {
        switch (strtolower($action)) {
            case 'open':
            case 'start':
            case 'begin':
                $output = sprintf('<map name="%s"', $name);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            case 'close':
            case 'stop':
            case 'end':
                $output = '</map>';
                break;
            case 'full':
                $output = sprintf('<map name="%s"', $name);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= sprintf('>%s</map>', $input);
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->map($action, $id, $class, $attributes, $name, $input*)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('map');
                $errorMsg .= '<ul><b>$input:</b> [Optional]';
                $errorMsg .= '<li>All the area-tags you want to add as a string.<br>';
                $errorMsg .= 'If you don\'t have attributes to add, you need to use it as followed:<br>';
                $errorMsg .= "\$string = \$htmlClass->area('full', '', '', '', 'rect', '0,0,20,20', 'http://www.link1.be/', 'link1');<br>";
                $errorMsg .= "\$string.= \$htmlClass->area('full', '', '', '', 'circle', '30,30,10', 'http://www.link2.be/', 'link2');<br>";
                $errorMsg .= "className->map('full', 'imageName', '', \$string)<br></li>";
                $errorMsg .= ('</ul>');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add a mark-tag
     *
     * The &lt;mark&gt; tag defines marked text.
     * Use the &lt;mark&gt; tag if you want to highlight parts of your text.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function mark($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('mark', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a meta-tag
     *
     * Metadata is data (information) about data.
     * The &lt;meta&gt; tag provides metadata about the HTML document.
     * Metadata will not be displayed on the page, but will be machine parsable.
     * Meta elements are typically used to specify page description, keywords,
     * author of the document, last modified, and other metadata.
     * The metadata can be used by browsers (how to display content or reload page),
     * search engines (keywords), or other web services.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $type Can be: name / http-equiv or charset
     * @param string $typeValue - name: Specifies a name for the metadata
     *                          - http-equiv: Provides an HTTP header for the information/value of the content attribute
     *                          - charset: Specifies the character encoding for the HTML document
     * @param string $content Gives the value associated with the http-equiv or name attribute
     * @return string
     */
    public function meta($action, $id, $class, $attributes, $type, $typeValue, $content = '')
    {
        switch (strtolower($action)) {
            case 'full':
                $output = sprintf('<meta %s="%s"', $type, $typeValue);
                if ($content != '') $output .= sprintf(' content="%s"', $content);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->meta($action, $id, $class, $attributes, $type, $typeValue, $content*)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('meta');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add a meter-tag
     *
     * The &lt;meter&gt; tag defines a scalar measurement within a known
     * range, or a fractional value. This is also known as a gauge.
     * Examples: Disk usage, the relevance of a query result, etc.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $value Required. Specifies the current value of the gauge
     * @param string $text This is shown when the browser doesn't support the meter-tag
     * @return string
     */
    public function meter($action, $id, $class, $attributes, $value, $text = '')
    {
        switch (strtolower($action)) {
            case 'open':
            case 'start':
            case 'begin':
                $output = sprintf('<meter value="%s"', $value);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            case 'close':
            case 'stop':
            case 'end':
                $output = '</meter>';
                break;
            case 'full':
                $output = sprintf('<meter value="%s"', $value);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= sprintf('>%s</meter>', $text);
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->meter($action, $id, $class, $attributes, $value, $text*)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('meter');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add a nav-tag
     *
     * The &lt;nav&gt; tag defines a set of navigation links.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function nav($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('nav', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a noscript-tag
     *
     * The &lt;noscript&gt; tag defines an alternate content for users that
     * have disabled scripts in their browser or have a browser that doesn't support script.
     * The &lt;noscript&gt; element can be used in both &lt;head&gt; and &lt;body&gt;.
     * When used inside the &lt;head&gt; element: &lt;noscript&gt; must contain
     * only &lt;link&gt;, &lt;style&gt;, and &lt;meta&gt; elements.
     * The content inside the &lt;noscript&gt; element will be displayed if scripts
     * are not supported, or are disabled in the user's browser.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     *                       - <i>warning</i>: Standard English warning text when JavaScript is disabled
     *                       - <i>waarschuwing</i>: Standard Dutch warning text when JavaScript is disabled
     *                       - <i>alerte</i>: Standard French warning text when JavaScript is disabled
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function noscript($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        switch (strtolower($action)) {
            case 'open':
            case 'start':
            case 'begin':
                $output = '<noscript';
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            case 'close':
            case 'stop':
            case 'end':
                $output = '</noscript>';
                break;
            case 'waarschuwing':
                $output = '<p id="noScriptText">Om deze site optimaal te gebruiken is het noodzakelijk om Javascript aan te zetten.<br>';
                $output .= '<a href="http://www.enable-javascript.com/nl/" target="_blank">Hier vind je instructies over hoe je Javascript activeert in je web browser</a>.</p>';
                break;
            case 'warning':
                $output = '<p id="noScriptText">For full functionality of this site it is necessary to enable JavaScript.<br>';
                $output .= 'Here are the <a href="http://www.enable-javascript.com/" target="_blank"> instructions how to enable JavaScript in your web browser</a>.</p>';
                break;
            case 'alerte':
                $output = '<p id="noScriptText">Pour accéder à toutes les fonctionnalités de ce site, vous devez activer JavaScript.';
                $output .= 'Voici les <a href="http://www.enable-javascript.com/fr/" target="_blank">
 instructions pour activer JavaScript dans votre navigateur Web</a>.</p>';
                break;
            case 'full':
                $output = '<noscript';
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= sprintf('>%s</noscript>', $input);
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->noscript($action, $id*, $class*, $attributes*, $input)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('noscript');
                $errorMsg .= '<ul><b>$action: <i>These extra options are possible</i></b>';
                $errorMsg .= '<li><i>warning</i>: English warning when JavaScript is disabled</li>';
                $errorMsg .= '<li><i>waarschuwing</i>: Dutch warning when JavaScript is disabled</li>';
                $errorMsg .= '<li><i>alerte</i>: French warning when JavaScript is disabled</li>';
                $errorMsg .= ('</ul>');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add an object-tag
     *
     * The &lt;objectagt; tag defines an embedded object within an HTML document.
     * Use this element to embed multimedia (like audio, video, Java applets,
     * ActiveX, PDF, and Flash) in your web pages.
     * You can also use the alt;objectagt; tag to embed another webpage into your HTML document.
     * You can use the &lt;param&gt; tag to pass parameters to plugins that have
     * been embedded with the &lt;object&gt; tag.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $data Specifies the URL of the resource to be used by the object
     * @param string $type Specifies the media type of data specified in the data attribute
     * @param int $width Specifies the width of the object
     * @param int $height Specifies the height of the object
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function object($action, $id, $class, $attributes, $data, $type = '', $width = 0, $height = 0, $input = '')
    {
        switch (strtolower($action)) {
            case 'open':
            case 'start':
            case 'begin':
                $output = sprintf('<object data="%s"', $data);
                if ($type != '') $output .= sprintf(' type="%s"', $type);
                $output .= $this->addExtras($id, $class, $attributes);
                if ($width != 0) $output .= sprintf(' width="%s"', $width);
                if ($height != 0) $output .= sprintf(' height="%s"', $height);
                $output .= '>';
                break;
            case 'close':
            case 'stop':
            case 'end':
                $output = '</object>';
                break;
            case 'full':
                $output = sprintf('<object data="%s"', $data);
                if ($type != '') $output .= sprintf(' type="%s"', $type);
                $output .= $this->addExtras($id, $class, $attributes);
                if ($width != 0) $output .= sprintf(' width="%s"', $width);
                if ($height != 0) $output .= sprintf(' height="%s"', $height);
                $output .= sprintf('>%s</object>', $input);
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->object($action, $id, $class, $attributes, $data, $type*, $width*, $height*, $input*)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('object');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add an ol-tag
     *
     * The &lt;ol&gt; tag defines an ordered list. An ordered list can be numerical or alphabetical.
     * Use the &lt;li&gt; tag to define list items.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function ol($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('ol', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add an optgroup-tag
     *
     * The &lt;optgroup&gt; is used to group related options in a drop-down list.
     * If you have a long list of options, groups of related options are
     * easier to handle for a user.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $label Specifies a label for an option-group
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function optgroup($action, $id, $class, $attributes, $label, $input = '')
    {
        switch (strtolower($action)) {
            case 'open':
            case 'start':
            case 'begin':
                $output = sprintf('<optgroup label="%s"', $label);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            case 'close':
            case 'stop':
            case 'end':
                $output = '</optgroup>';
                break;
            case 'full':
                $output = sprintf('<optgroup label="%s"', $label);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= sprintf('>%s</object>', $input);
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->optgroup($action, $id, $class, $attributes, $label, $input*)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('object');
                $errorMsg .= '<ul><b>$input:</b> [Optional]';
                $errorMsg .= '<li>You can pre-prepare a list of options and add it to the optgroup.<br>';
                $errorMsg .= "\$input = className->option('full', '', '', '', 'volvo', 'Volvo')<br>";
                $errorMsg .= "\$input.= className->option('full', '', '', '', 'honda', 'Honda', 'selected')<br>";
                $errorMsg .= "\$input.= className->option('full', '', '', '', 'bmw', 'BMW')<br>";
                $errorMsg .= "className->optgroup('full', '', '', '', 'variable', \$input)<br></li>";
                $errorMsg .= ('</ul>');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add an option-tag
     *
     * The &lt;option&gt; tag defines an option in a select list.
     * &lt;option&gt; elements go inside a &lt;select&gt; or &lt;datalist&gt; element.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $value Specifies the value to be sent to a server
     * @param string $text The text that has to be displayed with this element
     * @return string
     */
    public function option($action, $id, $class, $attributes, $value, $text = '')
    {
        switch (strtolower($action)) {
            case 'open':
            case 'start':
            case 'begin':
                $output = sprintf('<option value="%s"', $value);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            case 'close':
            case 'stop':
            case 'end':
                $output = '</option>';
                break;
            case 'full':
                $output = sprintf('<option value="%s"', $value);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= sprintf('>%s</option>', $text);
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->option($action, $id, $class, $attributes, $value, $text)<br>';
                $errorMsg .= $this->w3schoolsAttr('option');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add an output-tag
     *
     * The &lt;output&gt; tag represents the result of a calculation (like one performed by a script).
     *
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $name Specifies a name for the output element
     * @param string $for Specifies the relationship between the result of the calculation,
     *                    and the elements used in the calculation
     * @param string $text The content that has to be displayed with this element
     * @return string
     */
    public function output($action, $id, $class, $attributes, $name, $for, $text = '')
    {
        switch (strtolower($action)) {
            case 'open':
            case 'start':
            case 'begin':
                $output = sprintf('<output name="%s" for="%s"', $name, $for);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            case 'close':
            case 'stop':
            case 'end':
                $output = '</output>';
                break;
            case 'full':
                $output = sprintf('<output name="%s" for="%s"', $name, $for);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= sprintf('>%s</output>', $text);
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->output($action, $id, $class, $attributes, $name, $for, $text*)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('output');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add a p-tag
     *
     * The &lt;p&gt; tag defines a paragraph.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function p($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('p', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a param-tag
     *
     * In HTML the &lt;param&gt; tag has no end tag.
     *
     * @param string $action - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string $attributes All the extra attributes you want to add
     * @param string $name Specifies the name of a parameter
     * @param string $value Specifies the value of the parameter
     * @return string
     */
    public function param($action, $id, $class, $attributes, $name, $value)
    {
        switch (strtolower($action)) {
            case 'full':
                $output = sprintf('<param name="%s" value="%s"', $name, $value);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->param($action, $id, $class, $attributes, $name, $value)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('param');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add a pre-tag
     *
     * Use the &lt;preagt; element when displaying text with unusual formatting, or some sort of computer code.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function pre($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('pre', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a progress-tag
     *
     * The &lt;progress&gt; tag represents the progress of a task.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param int $value Specifies how much of the task has been completed
     * @param int $max Specifies how much work the task requires in total
     * @return string
     */
    public function progress($action, $id, $class, $attributes, $value, $max)
    {
        switch (strtolower($action)) {
            case 'open':
            case 'start':
            case 'begin':
                $output = sprintf('<progress value="%s" max="%s"', $value, $max);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            case 'close':
            case 'stop':
            case 'end':
                $output = '</progress>';
                break;
            case 'full':
                $output = sprintf('<progress value="%s" max="%s"', $value, $max);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '></progress>';
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->progress($action, $id, $class, $attributes, $value, $max)<br>';
                $errorMsg .= $this->w3schoolsAttr('param');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add a q-tag
     *
     * The &lt;q&gt; tag defines a short quotation.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function q($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('q', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a rp-tag
     *
     * The &lt;rp&gt; tag can be used to provide parentheses around a ruby text,
     * to be shown by browsers that do not support ruby annotations.
     * Use the &lt;rp&gt; tag together with the &lt;ruby&gt; and the &lt;rt&gt; tags:
     * The &lt;ruby&gt; element consists of one or more characters that needs an
     * explanation/pronunciation, and an &lt;rt&gt; element that gives that information,
     * and an optional &lt;rp&gt; element that defines what to show for browsers that
     * not support ruby annotations.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function rp($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('rp', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a rt-tag
     *
     * The &lt;rt&gt; tag defines an explanation or pronunciation of characters
     * (for East Asian typography) in a ruby annotation.
     * Use the &lt;rt&gt; tag together with the &lt;ruby&gt; and the &lt;rp&gt; tags:
     * The &lt;ruby&gt; element consists of one or more characters that needs an
     * explanation/pronunciation, and an &lt;rt&gt; element that gives that information,
     * and an optional &lt;rp&gt; element that defines what to show for browsers that
     * not support ruby annotations.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function rt($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('rt', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a ruby-tag
     *
     * The &lt;ruby&gt; tag specifies a ruby annotation.
     * A ruby annotation is a small extra text, attached to the main text to indicate
     * the pronunciation or meaning of the corresponding characters. This kind of
     * annotation is often used in Japanese publications.
     * Use the &lt;ruby&gt; tag together with the &lt;rt&gt; and/or the &lt;rp&gt; tags:
     * The &lt;ruby&gt; element consists of one or more characters that needs an
     * explanation/pronunciation, and an &lt;rt&gt; element that gives that information,
     * and an optional &lt;rp&gt; element that defines what to show for browsers that
     * not support ruby annotations.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function ruby($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('ruby', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a s-tag
     *
     * The &lt;s&gt; tag specifies text that is no longer correct, accurate or relevant.
     * The &lt;s&gt; tag should not be used to define replaced or deleted text, use the
     * &lt;del&gt; tag to define replaced or deleted text.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function s($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('s', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a samp-tag
     *
     * The &lt;sampagt; tag is a phrase tag. It defines sample output from a computer program.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function samp($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('samp', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a script-tag
     *
     * The &lt;script&gt; tag is used to define a client-side script (JavaScript).
     * The &lt;script&gt; element either contains scripting statements, or it points
     * to an external script file through the src attribute.
     * Common uses for JavaScript are image manipulation, form validation, and dynamic changes of content.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $src Specifies the URL of an external script file
     * @param string $type Specifies the media type of the script
     * @param string $code JavaScript code that you want to add
     * @return string
     */
    public function script($action, $id = '', $class = '', $attributes = '', $src = '', $type = '', $code = '')
    {
        switch (strtolower($action)) {
            case 'open':
            case 'start':
            case 'begin':
                $output = '<script';
                $output .= $this->addExtras($id, $class, $attributes);
                if ($src != '') $output .= sprintf(' src="%s"', $src);
                if ($type != '') $output .= sprintf(' type="%s"', $type);
                $output .= '>';
                break;
            case 'close':
            case 'stop':
            case 'end':
                $output = '</script>';
                break;
            case 'full':
                $output = '<script';
                $output .= $this->addExtras($id, $class, $attributes);
                if ($src != '') $output .= sprintf(' src="%s"', $src);
                if ($type != '') $output .= sprintf(' type="%s"', $type);
                $output .= sprintf('>%s</script>', $code);
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->script($action, $id*, $class*, $attributes*, $src*, $type*, $code*)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('meter');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add a section-tag
     *
     * The &lt;section&gt; tag defines sections in a document, such as chapters,
     * headers, footers, or any other sections of the document.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function section($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('section', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a select-tag
     *
     * The &lt;select&gt; element is used to create a drop-down list.
     * The &lt;option&gt; tags inside the &lt;select&gt; element define the available options in the list.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $name Defines a name for the drop-down list
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function select($action, $id = '', $class = '', $attributes = '', $name = '', $input = '')
    {
        switch (strtolower($action)) {
            case 'open':
            case 'start':
            case 'begin':
                $output = '<select';
                if ($name != '') $output .= sprintf(' name="%s"', $name);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            case 'close':
            case 'stop':
            case 'end':
                $output = '</select>';
                break;
            case 'full':
                $output = '<select';
                if ($name != '') $output .= sprintf(' name="%s"', $name);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= sprintf('>%s</select>', $input);
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->select($action, $id*, $class*, $attributes*, $name*, $input*)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('select');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add a small-tag
     *
     * The &lt;small&gt; tag defines smaller text (and other side comments).
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function small($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('small', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a source-tag
     *
     * The &lt;source&gt; tag is used to specify multiple media resources for media
     * elements, such as &lt;video&gt; and &lt;audio&gt;.
     * The &lt;source&gt; tag allows you to specify alternative video/audio files
     * which the browser may choose from, based on its media type or codec support.
     *
     * @param string $action - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $src Specifies the URL of the media file
     * @param string $type Specifies the media type of the media resource
     * @param string $media Specifies the type of media resource
     * @return string
     */
    public function source($action, $id, $class, $attributes, $src, $type, $media = '')
    {
        switch (strtolower($action)) {
            case 'full':
                $output = sprintf('<source src="%s" type="%s"', $src, $type);
                if ($media == '') $output .= sprintf(' media="%s"', $media);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->source($action, $id, $class, $attributes, $src, $type, $media*)<br>';
                $errorMsg .= $this->w3schoolsAttr('source');
                $errorMsg .= 'Extra information about the media types can be found ' . $this->a('full', '', '', 'target="_blank"', 'http://www.iana.org/assignments/media-types/media-types.xhtml', '>here<') . '.';
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add a span-tag
     *
     * The &lt;span&gt; tag is used to group inline-elements in a document.
     * The &lt;span&gt; tag provides no visual change by itself.
     * The &lt;span&gt; tag provides a way to add a hook to a part of a text or a part of a document.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function span($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('span', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a strong-tag
     *
     * The &lt;strong&gt; tag is a phrase tag. It defines important text.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function strong($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('strong', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a style-tag
     *
     * The &lt;style&gt; tag is used to define style information for an HTML document.
     * Inside the &lt;style&gt; element you specify how HTML elements should render in a browser.
     * Each HTML document can contain multiple &lt;style&gt; tags.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function style($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('style', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a sub-tag
     *
     * The &lt;sub&gt; tag defines subscript text. Subscript text appears half a character
     * below the normal line, and is sometimes rendered in a smaller font. Subscript text
     * can be used for chemical formulas, like H<sub>2</sub>O.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function sub($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('sub', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a summary-tag
     *
     * The &lt;summary&gt; tag defines a visible heading for the &lt;details&gt; element.
     * The heading can be clicked to view/hide the details.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function summary($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('summary', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a sup-tag
     *
     * The &lt;sup&gt; tag defines superscript text. Superscript text appears half a character
     * above the normal line, and is sometimes rendered in a smaller font. Superscript text can
     * be used for footnotes, like WWW<sup>[1]</sup>.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function sup($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('sup', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a table-tag
     *
     * The &lt;table&gt; tag defines an HTML table.
     * An HTML table consists of the &lt;table&gt; element and one or more &lt;tr&gt;,
     * &lt;th&gt;, and &lt;td&gt; elements.
     * The &lt;tr&gt; element defines a table row, the &lt;th&gt; element defines a table header,
     * and the &lt;td&gt; element defines a table cell.
     * A more complex HTML table may also include alt;captionagt;, &lt;col&gt;, &lt;colgroup&gt;, &lt;thead&gt;,
     * &lt;tfoot&gt;, and &lt;tbody&gt; elements.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function table($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('table', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a tbody-tag
     *
     * The &lt;tbody&gt; tag is used to group the body content in an HTML table.
     * The &lt;tbody&gt; element is used in conjunction with the &lt;thead&gt; and &lt;tfoot&gt; elements to specify
     * each part of a table (body, header, footer).
     * Browsers can use these elements to enable scrolling of the table body independently of the
     * header and footer. Also, when printing a large table that spans multiple pages, these elements
     * can enable the table header and footer to be printed at the top and bottom of each page.
     * The &lt;tbody&gt; tag must be used in the following context: As a child of a &lt;table&gt; element, after
     * any &lt;caption&gt;, &lt;colgroup&gt;, and &lt;thead&gt; elements.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function tbody($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('tbody', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a td-tag
     *
     * The &lt;td&gt; tag defines a standard cell in an HTML table.
     * The text in &lt;td&gt; elements are regular and left-aligned by default.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function td($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('td', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a textarea-tag
     *
     * The &lt;textareaagt; tag defines a multi-line text input control.
     * A text area can hold an unlimited number of characters, and the text renders
     * in a fixed-width font (usually Courier).
     * The size of a text area can be specified by the cols and rows attributes,
     * or even better; through CSS' height and width properties.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $name Specifies a name for a text area
     * @param int $rows Specifies the visible number of lines in a text area
     * @param int $cols Specifies the visible width of a text area
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function textarea($action, $id = '', $class = '', $attributes = '', $name = '', $rows = 0, $cols = 0, $input = '')
    {
        switch (strtolower($action)) {
            case 'open':
            case 'start':
            case 'begin':
                $output = '<textarea';
                if ($name != '') $output .= sprintf(' name="%s"', $name);
                if ($rows != 0) $output .= sprintf(' rows="%d"', $rows);
                if ($cols != 0) $output .= sprintf(' cols="%d"', $cols);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            case 'close':
            case 'stop':
            case 'end':
                $output = '</textarea>';
                break;
            case 'full':
                $output = '<textarea';
                if ($name != '') $output .= sprintf(' name="%s"', $name);
                if ($rows != 0) $output .= sprintf(' rows="%d"', $rows);
                if ($cols != 0) $output .= sprintf(' cols="%d"', $cols);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= sprintf('>%s</textarea>', $input);
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->textarea($action, $id*, $class*, $attributes*, $name*, $rows*, $cols*, $input*)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('textarea');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add a tfoot-tag
     *
     * The &lt;tfootagt; tag is used to group footer content in an HTML table.
     * The &lt;tfoot&gt; element is used in conjunction with the &lt;thead&gt; and &lt;tbody&gt;
     * elements to specify each part of a table (footer, header, body).
     * Browsers can use these elements to enable scrolling of the table body independently
     * of the header and footer. Also, when printing a large table that spans multiple pages,
     * these elements can enable the table header and footer to be printed at the top and
     * bottom of each page.
     * The &lt;tfoot&gt; tag must be used in the following context: As a child of a &lt;table&gt; element,
     * after any &lt;caption&gt;, &lt;colgroup&gt;, and &lt;thead&gt; elements and before any &lt;tbody&gt; and &lt;tr&gt; elements.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function tfoot($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('tfoot', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a th-tag
     *
     * The &lt;th&gt; tag defines a header cell in an HTML table.
     * The text in &lt;th&gt; elements are bold and centered by default.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function th($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('th', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a thead-tag
     *
     * The &lt;thead&gt; tag is used to group header content in an HTML table.
     * The <thead> element is used in conjunction with the &lt;tbody&gt; and &lt;tfoot&gt;
     * elements to specify each part of a table (header, body, footer).
     * Browsers can use these elements to enable scrolling of the table body independently
     * of the header and footer. Also, when printing a large table that spans multiple pages,
     * these elements can enable the table header and footer to be printed at the top and
     * bottom of each page.
     * The &lt;thead&gt; tag must be used in the following context: As a child of a &lt;table&gt; element,
     * after any &lt;caption&gt;, and &lt;colgroup&gt; elements, and before any &lt;tbody&gt;, &lt;tfoot&gt;,
     * and &lt;tr&gt; elements.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function thead($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('thead', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a time-tag
     *
     * The &lt;time&gt; tag defines a human-readable date/time.
     * This element can also be used to encode dates and times in a machine-readable way so
     * that user agents can offer to add birthday reminders or scheduled events to the user's
     * calendar, and search engines can produce smarter search results.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function time($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('time', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a title-tag
     *
     * The &lt;title&gt; tag is required in all HTML documents and it defines the title of the document.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function title($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('title', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a tr-tag
     *
     * The &lt;tragt; tag defines a row in an HTML table.
     * A &lt;tr&gt; element contains one or more &lt;th&gt; or &lt;td&gt; elements.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function tr($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('tr', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a track-tag
     *
     * The &lt;track&gt; tag specifies text tracks for media elements (&lt;audio&gt; and &lt;video&gt;).
     * This element is used to specify subtitles, caption files or other files
     * containing text, that should be visible when the media is playing.
     *
     * @param string $action - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $src Required. Specifies the URL of the track file
     * @param string $kind Specifies the kind of text track
     * @param string $srclang Specifies the language of the track text data (required if kind="subtitles")
     * @param string $label Specifies the title of the text track
     * @return string
     */
    public function track($action, $id, $class, $attributes, $src, $kind = '', $srclang = '', $label = '')
    {
        switch (strtolower($action)) {
            case 'full':
                $output = sprintf('<track src="%s"', $src);
                if ($kind != '') $output .= sprintf(' kind="%s"', $kind);
                if ($srclang != '') $output .= sprintf(' srclang="%s"', $srclang);
                if ($label != '') $output .= sprintf(' label="%s"', $label);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->track($action, $id, $class, $attributes, $src, $kind*, $srclang*, $label*)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('track');
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add a u-tag
     *
     * The &lt;u&gt; tag represents some text that should be stylistically different from normal
     * text, such as misspelled words or proper nouns in Chinese.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function u($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('u', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a ul-tag
     *
     * The &lt;ul&gt; tag defines an unordered (bulleted) list.
     * Use the &lt;ul&gt; tag together with the &lt;li&gt; tag to create unordered lists.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function ul($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('ul', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add a var-tag
     *
     * The &lt;varagt; tag is a phrase tag. It defines a variable.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    public function _var($action, $id = '', $class = '', $attributes = '', $input = '')
    {
        return $this->newTag('var', $action, $id, $class, $attributes, $input);
    }

    /**
     * Use this to add an video-tag
     *
     * The &lt;video&gt; tag specifies video, such as a movie clip or other video streams.
     *
     * How to use this in your code?
     * <i>First you have to create the source to be used, you do this by making an array.</i>
     * $source = array();
     * $source['video/mp4'] = 'your_video_file.mp4';
     * $source['video/ogg'] = 'your_video_file.ogg';
     * $source['video/webm'] = 'your_video_file.webm';
     * <i>Then you call the function.</i>
     * echo $html->video('full', '', '', 'controls autoplay', 'Your browser does not support the video.', $source);
     * At the moment, only MP4, Ogg and WebM are supported. You can add different sources and the browser will use the one it supports.
     *
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add (Default = controls)
     * @param string $input The content that has to be displayed with this element
     * @param array $videoSource An array that provides the video options
     * @return string
     */
    public function video($action, $id = '', $class = '', $attributes = 'controls', $input = 'Your browser does not support the video tag.', $videoSource = NULL)
    {
        switch (strtolower($action)) {
            case 'open':
            case 'start':
            case 'begin':
                $output = '<video';
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            case 'close':
            case 'stop':
            case 'end':
                $output = '</video>';
                break;
            case 'full':
                $output = '<video';
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                foreach ($videoSource as $type => $source) {
                    $output .= sprintf('<source src="%s" type="%s">', $source, $type);
                }
                $output .= $input;
                $output .= '</video>';
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->video($action, $id*, $class*, $attributes*, $input*, $videoSource*)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('video');
                $errorMsg .= 'How to use this in your code?<br>';
                $errorMsg .= '<i>// First you have to create the source to be used, you do this by making an array.</i><br>';
                $errorMsg .= '$source = array();<br>';
                $errorMsg .= "\$source['video/mp4'] = 'your_video_file.mp4';<br>";
                $errorMsg .= "\$source['video/ogg'] = 'your_video_file.ogg';<br>";
                $errorMsg .= "\$source['video/webm'] = 'your_video_file.webm';<br>";
                $errorMsg .= '<i>// Then you call the function.</i><br>';
                $errorMsg .= 'echo $html->video(\'full\', \'\', \'\', \'controls autoplay\', \'Your browser does not support the video.\', $source);<br>';
                $errorMsg .= '<br>';
                $errorMsg .= 'At the moment, only MP4, Ogg and WebM are supported. You can add different sources and the browser will use the one it supports.';
                die($errorMsg);
        }
        return $output;
    }

    /**
     * Use this to add a wbr-tag
     *
     * The &lt;wbr&gt; (Word Break Opportunity) tag specifies where in a text
     * it would be ok to add a line-break.
     *
     * @param string $action - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @return string
     */
    public function wbr($action, $id = '', $class = '', $attributes = '')
    {
        switch (strtolower($action)) {
            case 'full':
                $output = '<wbr';
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= 'class.HTML5->br($id*, $class*, $attributes*)<br>';
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr('wbr');
                die($errorMsg);
        }
        return $output;
    }

#### Private functions ####

    /**
     * This private function is used to add more information about $attributes with the different HTML-elements
     *
     * @param string $tag The HTML tag
     * @return string
     */
    private function w3schoolsAttr($tag)
    {
        switch ($tag) {
            case 'h1':
            case 'h2':
            case 'h3':
            case 'h4':
            case 'h5':
            case 'h6':
                $w3tag = 'hn';
                break;
            default:
                $w3tag = $tag;
        }

        $output = '<b><u>w3schools</u></b>';
        $output .= sprintf('More information about the &lt;%s&gt;-tag can be found at:<br>', $tag);
        $urlLink = sprintf('http://www.w3schools.com/tags/tag_%s.asp', $w3tag);
        $output .= $this->a('full', '', '', 'target="_blank"', $urlLink, 'w3schools page.') . '<br>';
        $output .= 'More information about adding Global- and/or Event Attributes can be found at:<br>';
        $output .= $this->a('full', '', '', 'target="_blank"', 'http://www.w3schools.com/tags/ref_standardattributes.asp', 'w3schools Global Attributes page.') . '<br>';
        $output .= $this->a('full', '', '', 'target="_blank"', 'http://www.w3schools.com/tags/ref_eventattributes.asp', 'w3schools Event Attributes page.') . '<br>';
        return $output;
    }

    /**
     * This private function is used to process $attributes used by different HTML-elements
     *
     * @param string|array $attributes A string or array of attributes
     * @return string
     */
    private function processAttributes($attributes)
    {
        $stringAttributes = '';
        if (is_array($attributes)) {
            foreach ($attributes as $key => $value) {
                $stringAttributes .= sprintf(' %s="%s"', $key, $value);
            }
        } else {
            $stringAttributes .= sprintf(' %s', $attributes);
        }
        return $stringAttributes;
    }

    /**
     * This private function is used to add $id, $class and $attributes to an HTML-element
     *
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @return string
     */
    private function addExtras($id, $class, $attributes)
    {
        $extra = '';
        if ($id != '') $extra .= sprintf(' id="%s"', $id);
        if ($class != '') $extra .= sprintf(' class="%s"', $class);
        if ($attributes != '') $extra .= $this->processAttributes($attributes);
        return $extra;
    }

    /**
     * This private function is used for all the tags that have a common structure
     *
     * @param string $tag The HTML element you want to use
     * @param string $action - <i>open/start/begin</i>: Opens the element
     *                       - <i>close/stop/end</i>: Closes the element
     *                       - <i>full</i>: Opens and closes the element, $input is used for the
     *                                      contents that has to be displayed
     * @param string $id The id of the element
     * @param string $class The class of the element
     * @param string|array $attributes All the extra attributes you want to add
     * @param string $input The content that has to be displayed with this element
     * @return string
     */
    private function newTag($tag, $action, $id = '', $class = '', $attributes = '', $input = '')
    {
        switch (strtolower($action)) {
            case 'open':
            case 'start':
            case 'begin':
                $output = sprintf('<%s', $tag);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= '>';
                break;
            case 'close':
            case 'stop':
            case 'end':
                $output = sprintf('</%s>', $tag);
                break;
            case 'full':
                $output = sprintf('<%s', $tag);
                $output .= $this->addExtras($id, $class, $attributes);
                $output .= sprintf('>%s</%s>', $input, $tag);
                break;
            default:
                $errorMsg = '<b>!!! You made a mistake !!!</b><br>';
                $errorMsg .= 'You have to use it as:<br>';
                $errorMsg .= sprintf('class.HTML5->%s($action, $id*, $class*, $attributes*, $input*)<br>', $tag);
                $errorMsg .= '* These arguments are optional.<br>';
                $errorMsg .= $this->w3schoolsAttr($tag);
                die($errorMsg);
        }
        return $output;
    }
}
