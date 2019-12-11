( function( api ) {

	// Extends our custom "engager" section.
	api.sectionConstructor['engager'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );