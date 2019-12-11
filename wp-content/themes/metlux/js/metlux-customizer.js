( function( api ) {

	// Extends our custom "metlux" section.
	api.sectionConstructor['metlux'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );