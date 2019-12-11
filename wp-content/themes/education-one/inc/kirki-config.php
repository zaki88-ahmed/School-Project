<?php
/**
 * Kirki config
 *
 * @package education-one
 */
?>
<?php 
function education_one_kirki_config() {
	
	$l10n['background-color']      = esc_attr__( 'Background Color','education-one' );
	$l10n['background-image']      = esc_attr__( 'Background Image','education-one' );
	$l10n['no-repeat']             = esc_attr__( 'No Repeat','education-one' );
	$l10n['repeat-all']            = esc_attr__( 'Repeat All','education-one' );
	$l10n['repeat-x']              = esc_attr__( 'Repeat Horizontally','education-one' );
	$l10n['repeat-y']              = esc_attr__( 'Repeat Vertically','education-one' );
	$l10n['inherit']               = esc_attr__( 'Inherit','education-one' );
	$l10n['background-repeat']     = esc_attr__( 'Background Repeat','education-one' );
	$l10n['cover']                 = esc_attr__( 'Cover','education-one' );
	$l10n['contain']               = esc_attr__( 'Contain','education-one' );
	$l10n['background-size']       = esc_attr__( 'Background Size','education-one' );
	$l10n['fixed']                 = esc_attr__( 'Fixed','education-one' );
	$l10n['scroll']                = esc_attr__( 'Scroll','education-one' );
	$l10n['background-attachment'] = esc_attr__( 'Background Attachment','education-one' );
	$l10n['left-top']              = esc_attr__( 'Left Top','education-one' );
	$l10n['left-center']           = esc_attr__( 'Left Center','education-one' );
	$l10n['left-bottom']           = esc_attr__( 'Left Bottom','education-one' );
	$l10n['right-top']             = esc_attr__( 'Right Top','education-one' );
	$l10n['right-center']          = esc_attr__( 'Right Center','education-one' );
	$l10n['right-bottom']          = esc_attr__( 'Right Bottom','education-one' );
	$l10n['center-top']            = esc_attr__( 'Center Top','education-one' );
	$l10n['center-center']         = esc_attr__( 'Center Center','education-one' );
	$l10n['center-bottom']         = esc_attr__( 'Center Bottom','education-one' );
	$l10n['background-position']   = esc_attr__( 'Background Position','education-one' );
	$l10n['background-opacity']    = esc_attr__( 'Background Opacity','education-one' );
	$l10n['on']                    = esc_attr__( 'ON','education-one' );
	$l10n['off']                   = esc_attr__( 'OFF','education-one' );
	$l10n['all']                   = esc_attr__( 'All','education-one' );
	$l10n['cyrillic']              = esc_attr__( 'Cyrillic','education-one' );
	$l10n['cyrillic-ext']          = esc_attr__( 'Cyrillic Extended','education-one' );
	$l10n['devanagari']            = esc_attr__( 'Devanagari','education-one' );
	$l10n['greek']                 = esc_attr__( 'Greek','education-one' );
	$l10n['greek-ext']             = esc_attr__( 'Greek Extended','education-one' );
	$l10n['khmer']                 = esc_attr__( 'Khmer','education-one' );
	$l10n['latin']                 = esc_attr__( 'Latin','education-one' );
	$l10n['latin-ext']             = esc_attr__( 'Latin Extended','education-one' );
	$l10n['vietnamese']            = esc_attr__( 'Vietnamese','education-one' );
	$l10n['hebrew']                = esc_attr__( 'Hebrew','education-one' );
	$l10n['arabic']                = esc_attr__( 'Arabic','education-one' );
	$l10n['bengali']               = esc_attr__( 'Bengali','education-one' );
	$l10n['gujarati']              = esc_attr__( 'Gujarati','education-one' );
	$l10n['tamil']                 = esc_attr__( 'Tamil','education-one' );
	$l10n['telugu']                = esc_attr__( 'Telugu','education-one' );
	$l10n['thai']                  = esc_attr__( 'Thai','education-one' );
	$l10n['serif']                 = _x( 'Serif', 'font style','education-one' );
	$l10n['sans-serif']            = _x( 'Sans Serif', 'font style','education-one' );
	$l10n['monospace']             = _x( 'Monospace', 'font style','education-one' );
	$l10n['font-family']           = esc_attr__( 'Font Family','education-one' );
	$l10n['font-size']             = esc_attr__( 'Font Size','education-one' );
	$l10n['font-weight']           = esc_attr__( 'Font Weight','education-one' );
	$l10n['line-height']           = esc_attr__( 'Line Height','education-one' );
	$l10n['font-style']            = esc_attr__( 'Font Style','education-one' );
	$l10n['letter-spacing']        = esc_attr__( 'Letter Spacing','education-one' );
	$l10n['top']                   = esc_attr__( 'Top','education-one' );
	$l10n['bottom']                = esc_attr__( 'Bottom','education-one' );
	$l10n['left']                  = esc_attr__( 'Left','education-one' );
	$l10n['right']                 = esc_attr__( 'Right','education-one' );
	$l10n['color']                 = esc_attr__( 'Color','education-one' );
	$l10n['add-image']             = esc_attr__( 'Add Image','education-one' );
	$l10n['change-image']          = esc_attr__( 'Change Image','education-one' );
	$l10n['remove']                = esc_attr__( 'Remove','education-one' );
	$l10n['no-image-selected']     = esc_attr__( 'No Image Selected','education-one' );
	$l10n['select-font-family']    = esc_attr__( 'Select a font-family','education-one' );
	$l10n['variant']               = esc_attr__( 'Variant','education-one' );
	$l10n['subsets']               = esc_attr__( 'Subset','education-one' );
	$l10n['size']                  = esc_attr__( 'Size','education-one' );
	$l10n['height']                = esc_attr__( 'Height','education-one' );
	$l10n['spacing']               = esc_attr__( 'Spacing','education-one' );
	$l10n['ultra-light']           = esc_attr__( 'Ultra-Light 100','education-one' );
	$l10n['ultra-light-italic']    = esc_attr__( 'Ultra-Light 100 Italic','education-one' );
	$l10n['light']                 = esc_attr__( 'Light 200','education-one' );
	$l10n['light-italic']          = esc_attr__( 'Light 200 Italic','education-one' );
	$l10n['book']                  = esc_attr__( 'Book 300','education-one' );
	$l10n['book-italic']           = esc_attr__( 'Book 300 Italic','education-one' );
	$l10n['regular']               = esc_attr__( 'Normal 400','education-one' );
	$l10n['italic']                = esc_attr__( 'Normal 400 Italic','education-one' );
	$l10n['medium']                = esc_attr__( 'Medium 500','education-one' );
	$l10n['medium-italic']         = esc_attr__( 'Medium 500 Italic','education-one' );
	$l10n['semi-bold']             = esc_attr__( 'Semi-Bold 600','education-one' );
	$l10n['semi-bold-italic']      = esc_attr__( 'Semi-Bold 600 Italic','education-one' );
	$l10n['bold']                  = esc_attr__( 'Bold 700','education-one' );
	$l10n['bold-italic']           = esc_attr__( 'Bold 700 Italic','education-one' );
	$l10n['extra-bold']            = esc_attr__( 'Extra-Bold 800','education-one' );
	$l10n['extra-bold-italic']     = esc_attr__( 'Extra-Bold 800 Italic','education-one' );
	$l10n['ultra-bold']            = esc_attr__( 'Ultra-Bold 900','education-one' );
	$l10n['ultra-bold-italic']     = esc_attr__( 'Ultra-Bold 900 Italic','education-one' );
	$l10n['invalid-value']         = esc_attr__( 'Invalid Value','education-one' );

	$args = array(
        'logo_image'     => get_template_directory_uri() . '/images/logo.png',
        'url_path'       => get_template_directory_uri() . '/inc/kirki/',
        'textdomain'     => 'education-one',
        'i18n'           => $l10n,		
        'disable_loader' => true,
    );
	return $args;
}
add_filter( 'kirki/config', 'education_one_kirki_config' );
?>