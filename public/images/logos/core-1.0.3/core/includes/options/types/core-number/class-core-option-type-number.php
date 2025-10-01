<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );

class Core_Option_Type_Number extends FW_Option_Type {
	public function get_type() {
		return 'core-number';
	}

	protected function _render( $id, $option, $data ) {
		$option['attr']['value']  = (string) $data['value'];
		$option['attr']['min']    = ( isset( $option['min'] ) ) ? (string) $option['min'] : '';
		$option['attr']['max']    = ( isset( $option['max'] ) ) ? (string) $option['max'] : '';
		$option['attr']['class'] .= ' fw-option-width-short';
		return '<input ' . fw_attr_to_html( $option['attr'] ) . ' type="number"/>';
	}

	protected function _get_value_from_input( $option, $input_value ) {
		$result_value = ( ( is_null( $input_value ) || ( ! is_numeric( $input_value ) ) ) ? $option['value'] : $input_value );
		$result_value = ( ( $result_value < $option['min'] ) ? $option['min'] : $result_value );
		return (string) $result_value;
	}

	protected function _get_defaults() {
		return array(
			'value' => '0'
		);
	}
}

FW_Option_Type::register( 'Core_Option_Type_Number' );

?>
