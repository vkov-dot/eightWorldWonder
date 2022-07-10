export default {
    data() {
        return {
            searchOption: '',
            searchMessage: '',
        }
    },
    methods: {
        search(notes) {
            if (this.searchMessage && this.searchOption) {
                let option = this.searchOption;
                let message = this.searchMessage;
                notes = notes.filter(note => note[option].includes(message))
            }

            return notes;
        },
    },
}
