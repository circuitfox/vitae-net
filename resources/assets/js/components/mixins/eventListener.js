export const eventListener = {
  methods: {
    findItem(id) {
      return this.items.findIndex(e => e.id === id);
    }
  },
  created() {
    Echo.channel(this.channel)
      .listen(this.eventAdded, e => {
        let item = this.eventItem;
        let index = this.findItem(e[item].id);
        if (index !== -1) {
          this.items.splice(this.findItem(e[item].id), 1, e[item]);
        } else {
          this.items.unshift(e[item])
        }
      })
      .listen(this.eventRemoved, e => {
        this.items.splice(this.findItem(e[this.eventItem].id), 1);
      });
  }
}
