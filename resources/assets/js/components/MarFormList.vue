<template>
  <div id="mar-form-list" v-if="items.length <= 0">
  </div>
  <div id="mar-form-list" v-else>
    <mar-form v-for="(item, index) in items"
                     :mrn= "mrn"
                     :meds= "meds"
                     :item="item"
                     :id="index"
                     :key="index"
                     :errors="errors"
                     @remove="items.splice(index, 1)"></mar-form>
    <div class="form-group">
      <div class="col-md-offset-2 col-md-2">
      </div>
    </div>
  </div>
</template>

<script>
    import MarForm from './MarForm.vue';

    export default {
        props: {
            mrn: {
                type: Number,
            },
            meds: {
                type: Object,
            },
            errors: {
                type: Object,
                default: {},
            },
            old: {
                type: Array,
                default: () => [],
            }
        },
        components: {
            'mar-form': MarForm
        },
        data() {
            return {
                items: this.old || []
            }
        },
        methods: {
            addMar(data) {
                this.items.push(data);
            }
        },
        created() {
            this.$parent.$on('add-mar', this.addMar);
        }
    }
</script>
