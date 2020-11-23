$.validator.addMethod( "strongPassword", function( value, element ) {
	// return this.optional( element ) || /^\w+$/i.test( value );
	return this.optional( element ) || /((?=.*[A-Z])(?=.*\W))/.test( value );
}, "Ít nhất 1 ký tự hoa, 1 ký tự đặc biệt!" );
