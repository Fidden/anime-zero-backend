export default {
	data() {
		return {
			notifications: [
				{id: 0, title: 'Title', body: 'some body text'}
			],
		};
	},
	methods: {
		addNotify(title, name) {
			this.notifications.push({id: this.notifications.length, title: title, name: name});
			setTimeout(() => this.notifications.pop(), 5000);
		},
		removeNotify(id) {
			this.notifications.splice(this.notifications.findIndex(item => item.id === id));
		},
		removeNotifyByIndex(index) {
			this.notifications.splice(index);
		}
	}
};
