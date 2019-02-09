<template>
  <div v-if="success">
    <a class="list-group-item list-group-item-success" :href="linkRoute">{{ name }}</a>
  </div>
  <div v-else>
    <a class="list-group-item list-group-item-danger" :href="linkRoute">{{ name }}</a>
  </div>
</template>

<script>
export default {
  props: {
    name: {
      type: String,
      required: true,
    },
    id: {
      type: Number,
      required: true,
    },
    success: {
      type: Number,
      default: false,
    },
    head: {
      type: String,
      required: true,
    }
  },
  computed: {
    linkRoute: function() {
      return this.head + '/' + this.id;
    }
  }
}
</script>
