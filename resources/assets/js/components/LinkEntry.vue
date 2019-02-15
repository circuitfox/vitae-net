<template>
  <a class="list-group-item" v-bind:class="styles" :href="linkRoute">{{ name }}</a>
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
      type: Boolean,
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
    },
    styles: function() {
      return {
        'list-group-item-success': this.success,
        'list-group-item-danger': !this.success,
      };
    }
  }
}
</script>
