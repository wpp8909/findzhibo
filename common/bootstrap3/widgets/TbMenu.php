<?php
/**
 * TbMenu class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 */

Yii::import('bootstrap3.widgets.TbBaseMenu');

/**
 * Bootstrap menu.
 * @see http://twitter.github.com/bootstrap/components.html#navs
 */
class TbMenu extends TbBaseMenu {
	// Menu types.
	const TYPE_TABS = 'tabs';
	const TYPE_PILLS = 'pills';

	/**
	 * @var string the menu type.
	 * Valid values are 'tabs' and 'pills'.
	 */
	public $type;
	/**
	 * @var string|array the scrollspy target or configuration.
	 */
	public $scrollspy;
	/**
	 * @var boolean indicates whether the menu should appear vertically stacked.
	 */
	public $stacked = false;
	/**
	 * @var boolean indicates whether dropdowns should be dropups instead.
	 */
	public $justified = false;

	/**
	 * Initializes the widget.
	 */
	public function init() {
		parent::init();

		$classes = array('nav');

		$validTypes = array(self::TYPE_TABS, self::TYPE_PILLS);

		if (isset($this->type) && in_array($this->type, $validTypes))
			$classes[] = 'nav-' . $this->type;
		else
			$classes[] = 'navbar-nav';

		if ($this->stacked)
			$classes[] = 'nav-stacked';

		if ($this->justified)
			$classes[] = 'nav-justified';


		if (isset($this->scrollspy)) {
			$scrollspy = is_string($this->scrollspy) ? array('target' => $this->scrollspy) : $this->scrollspy;
			$this->widget('bootstrap3.widgets.TbScrollSpy', $scrollspy);
		}

		if (!empty($classes)) {
			$classes = implode(' ', $classes);
			if (isset($this->htmlOptions['class']))
				$this->htmlOptions['class'] .= ' ' . $classes;
			else
				$this->htmlOptions['class'] = $classes;
		}
	}

	/**
	 * Returns the divider css class.
	 * @return string the class name
	 */
	public function getDividerCssClass() {
		return (isset($this->type) && $this->type === self::TYPE_LIST) ? 'divider' : 'divider-vertical';
	}

	/**
	 * Returns the dropdown css class.
	 * @return string the class name
	 */
	public function getDropdownCssClass() {
		return 'dropdown';
	}

	/**
	 * Returns whether this is a vertical menu.
	 * @return boolean the result
	 */
//	public function isVertical() {
//		return isset($this->type) && $this->type === self::TYPE_LIST;
//	}
}