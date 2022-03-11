export default {
	beforeMount(el, binding, vnode) {
		let vm = vnode.context;
		let callback = binding.value;

		el.clickOutsideEvent = function (event) {
			if (!(el === event.target || el.contains(event.target))) {
				return callback.call(vm, event);
			}
		};
		document.body.addEventListener('click', el.clickOutsideEvent);
	},
	unbind(el) {
		document.body.removeEventListener('click', el.clickOutsideEvent);
	}
};
