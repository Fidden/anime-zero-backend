export default {
    methods: {
        getRating(rating) {
            return String(rating).indexOf('.') === -1 ? `${rating}.0` : rating;
        }
    }
};
