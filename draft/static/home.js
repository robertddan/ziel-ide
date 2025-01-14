'use strict';

var home = {
	on: {
		load: function() {
			console.log('Hello world!');
		}
	}
};

document.addEventListener('DOMContentLoaded', () => home.on.load());