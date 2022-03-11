export default {
	methods: {
		disableBodyScroll(value) {
			document.body.style.overflowY = value ? 'hidden' : 'visible';
		}
	}
};
