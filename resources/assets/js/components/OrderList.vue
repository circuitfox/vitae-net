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
import { eventListener } from './mixins/eventListener.js';

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
  mixins: [eventListener],
  data() {
    return {
      items: this.orders,
      channel: 'orders.' + this.mrn,
      eventAdded: 'OrderAdded',
      eventRemoved: 'OrderRemoved',
      eventItem: 'order',
    }
  },
}
</script>
