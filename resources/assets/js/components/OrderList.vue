<template>
  <div class="panel-body" v-if="items.length <= 0">
    <h5 class="text-center text-muted">No Orders for
      <span class="text-capitalize">{{ name }}</span>
    </h5>
  </div>
  <ul class="list-group" v-else>
    <link-entry v-for="(item, index) in items"
                :name="item.name"
                :id="item.id"
                :success="item.completed !== 0"
                :head="route"
                :key="item.id"
                @remove="items.splice(index, 1)"></link-entry>
  </ul>
</template>

<script>
import LinkEntry from './LinkEntry.vue';

export default {
  props: {
    name: {
      type: String,
      required: true
    },
    route: {
      type: String,
      required: true
    },
    mrn: {
      type: Number,
      required: true
    },
    orders: {
      type: Array,
      default: [],
    }
  },
  components: {
    'link-entry': LinkEntry
  },
  methods: {
    findItem(id) {
      return this.items.findIndex(e => e.id === id);
    }
  },
  data() {
    return {
      items: this.orders
    }
  },
  created() {
    Echo.channel('orders.' + this.mrn)
      .listen('OrderAdded', e => {
        this.items.push(e.order);
      })
      .listen('OrderRemoved', e => {
        this.items.splice(this.findItem(e.order.id));
      });
  }
}
</script>
