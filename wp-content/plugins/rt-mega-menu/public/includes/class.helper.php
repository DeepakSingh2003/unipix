<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class RTMEGA_Helper {

	public static function add_responsive_vars ($attributes, &$target_array, $attr_base, $prop_name, $properties = [], $is_object = false) {
   		$devices = ['' => 'desktop', 'Tablet' => 'tablet', 'Mobile' => 'mobile'];
    
    	foreach ($devices as $d_suffix => $device) {
			$attr_name = $attr_base . $d_suffix;
			$val = isset($attributes[$attr_name]) && $attributes[$attr_name] !== '' ? $attributes[$attr_name] : null;
			
			if ($is_object && is_array($val)) {
				foreach ($properties as $prop_key => $css_prop) {
					if ( isset( $val[$prop_key] ) && $val[$prop_key] !== '' ) {
						$v = $val[$prop_key];
						if ( in_array( $prop_key, ['top', 'right', 'bottom', 'left', 'fontSize', 'letterSpacing'] ) ) {
							$v = self::ensure_unit($v);
						}
						$target_array[$device][$css_prop] = $v;
					}
				}
			} elseif ( ! $is_object && ! empty( $val ) ) {
				$v = $val;
				// You can add more logic here if needed for specific attributes
				$target_array[$device][$prop_name] = $v;
			}
		}
	}

	public static function ensure_unit ($value) {
		if ( $value === '' || $value === null ) return '0px';
		if ( is_numeric( $value ) && $value != 0 ) return $value . 'px';
		return $value;
	}

	public static function get_inline_styles ($style_map) {
		$styles = [];
    if ( ! is_array( $style_map ) ) return '';
		foreach ( $style_map as $prop => $value ) {
			if ( $value !== '' && $value !== null && $value !== 'inherit' ) {
				$styles[] = $prop . ':' . $value;
			}
		}
		return implode( ';', $styles );
	}

	public static function generate_responsive_css($selector, $responsive_data) {
		$css = "";
		$breakpoints = [
			'desktop' => '',
			'tablet'  => '@media (max-width: 1024px)',
			'mobile'  => '@media (max-width: 767px)'
		];

		foreach ($breakpoints as $device => $media) {
			if (!empty($responsive_data[$device]) && is_array($responsive_data[$device])) {
				$decls = "";
				foreach ($responsive_data[$device] as $prop => $val) {
					if ( $val !== '' && $val !== null ) {
						$decls .= $prop . ":" . $val . ";";
					}
				}
				
				if ( ! empty( $decls ) ) {
					if ($media) {
						$css .= $media . " { " . $selector . " { " . $decls . " } }\n";
					} else {
						$css .= $selector . " { " . $decls . " }\n";
					}
				}
			}
		}
		return $css;
	}

	public static function add_custom_style( $handle, $selector, $css = "", $sub_styles = [] ) {
		$output_css = $css;
		
		if ( is_array( $sub_styles ) ) {
			foreach ( $sub_styles as $sub_sel => $style ) {
				if ( ! empty( $style ) ) {
					// Prepend the selector to the sub-selector
                    $output_css .= $selector . " " . $sub_sel . " { " . $style . "; }\n";
				}
			}
		}

		if ( ! empty( $output_css ) ) {
            // Always echo for blocks to ensure it works even if enqueued too late.
            // CSS is generated from widget settings; strip any HTML tags that could
            // break out of the <style> block but keep CSS syntax (>, {}, etc.) intact.
            echo "<!-- RT Mega Menu Styles -->\n";
            echo '<style type="text/css">' . wp_strip_all_tags( $output_css ) . '</style>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- wp_strip_all_tags removes script/style injection while preserving CSS.
		}
	}
  
  public static function rtmega_build_dimensions_css($dimensions, $property) {
    if (empty($dimensions) || !is_array($dimensions)) {
        return '';
    }
    
    $unit = isset($dimensions['unit']) ? $dimensions['unit'] : 'px';
    $top = isset($dimensions['top']) && $dimensions['top'] !== '' ? $dimensions['top'] . $unit : '';
    $right = isset($dimensions['right']) && $dimensions['right'] !== '' ? $dimensions['right'] . $unit : '';
    $bottom = isset($dimensions['bottom']) && $dimensions['bottom'] !== '' ? $dimensions['bottom'] . $unit : '';
    $left = isset($dimensions['left']) && $dimensions['left'] !== '' ? $dimensions['left'] . $unit : '';
    
    if ($top || $right || $bottom || $left) {
        return $property . ': ' . ($top ?: '0') . ' ' . ($right ?: '0') . ' ' . ($bottom ?: '0') . ' ' . ($left ?: '0') . ';';
    }
    
    return '';
  }

  public static function rtmega_build_typography_css($typography) {
      if (empty($typography) || !is_array($typography)) {
          return '';
      }
      
      $css = '';
      if (!empty($typography['fontSize'])) {
          $css .= 'font-size: ' . esc_attr($typography['fontSize']) . ';';
      }
      if (!empty($typography['fontWeight']) && $typography['fontWeight'] !== 'inherit') {
          $css .= 'font-weight: ' . esc_attr($typography['fontWeight']) . ';';
      }
      if (!empty($typography['lineHeight'])) {
          $css .= 'line-height: ' . esc_attr($typography['lineHeight']) . ';';
      }
      if (!empty($typography['textTransform']) && $typography['textTransform'] !== 'none') {
          $css .= 'text-transform: ' . esc_attr($typography['textTransform']) . ';';
      }
      if (!empty($typography['letterSpacing'])) {
          $css .= 'letter-spacing: ' . esc_attr($typography['letterSpacing']) . ';';
      }
      
      return $css;
  }
}
