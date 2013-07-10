<?php

/* ## TbAlert class file.
 *
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright  Copyright &copy; Christoffer Niska 2011-
 * @license [New BSD License](http://www.opensource.org/licenses/bsd-license.php)
 * @package bootstrap.widgets
 */

/**
 * Bootstrap alert widget.
 *
 * @see http://twitter.github.com/bootstrap/javascript.html#alerts
 */
class WNotificator extends CWidget {
    // Alert types.

    const TYPE_ALERT = 'alert'; // same as error
    const TYPE_SUCCESS = 'success';
    const TYPE_ERROR = 'error';
    const TYPE_INFO = 'info';
    const TYPE_WARNING = 'warning';

    public $alerts = array();

    /**
     * @var string User-component for getting flash messages.
     */
    public $userComponentId = 'user';

    /**
     * ### .init()
     *
     * Initializes the widget.
     */
    public function init() {
        if (is_string($this->alerts)) {
            $this->alerts = array($this->alerts);
        }

        // Display all alert types by default.
        if (!isset($this->alerts) || empty($this->alerts)) {
            $this->alerts = array(
                self::TYPE_SUCCESS,
                self::TYPE_INFO,
                self::TYPE_WARNING,
                self::TYPE_ERROR,
                self::TYPE_ALERT
            );
        }
    }

    /**
     * ### .run()
     *
     * Runs the widget.
     */
    public function run() {

        /** @var CClientScript $cs */
        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile("http://needim.github.io/noty/js/noty/jquery.noty.js");
        $cs->registerScriptFile("http://needim.github.io/noty/js/noty/layouts/top.js");
        $cs->registerScriptFile("http://needim.github.io/noty/js/noty/layouts/topRight.js");
        $cs->registerScriptFile("http://needim.github.io/noty/js/noty/themes/default.js");

        foreach ($this->alerts as $type => $alert) {
            if (is_string($alert)) {
                $type = $alert;
                $alert = array();
            }

            if (isset($alert['visible']) && $alert['visible'] === false) {
                continue;
            }

            if (Yii::app()->getComponent($this->userComponentId)->hasFlash($type)) {
                $validTypes = array(
                    self::TYPE_SUCCESS,
                    self::TYPE_INFO,
                    self::TYPE_WARNING,
                    self::TYPE_ERROR,
                    self::TYPE_ALERT
                );

                if (in_array($type, $validTypes)) {
                    $id = uniqid();
                    $text = Yii::app()->getComponent($this->userComponentId)->getFlash($type);
                    Yii::app()->clientScript->registerScript($id, "
                        var noty_{$id} = noty({
                            text: '{$text}',
                            'layout':'topRight',
                            template: '<div class=\"noty_message\"><span class=\"noty_text\"></span><div class=\"noty_close\"></div></div>',
                             closeWith: ['button'], // ['click', 'button', 'hover']                            
                            type: '{$type}',
                                callback: {                            
                                    afterShow: function() {setTimeout(function(){
                                        noty_{$id}.close('noty_{$id}'); 
                                    }, 3000);},                                  
                                  },
                                                                });
                        ");
                }
            }
        }
    }

}
