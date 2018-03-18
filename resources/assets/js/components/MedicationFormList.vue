<template>
  <div id="medication-form-list" v-if="items.length <= 0">
  </div>
  <div id="medication-form-list" v-else>
    <medication-form v-for="(item, index) in items"
                     :item="item"
                     :id="index"
                     :key="index"
                     :errors="errors"
                     @remove="items.splice(index, 1)"></medication-form>
  </div>
</template>

<script>
    import MedicationForm from './MedicationForm.vue';

    export default {
        props: {
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
            'medication-form': MedicationForm
        },
        data() {
            return {
                items: this.old || []
            }
        },
        methods: {
            addMedication(data) {
                this.items.push(data);
            },
        },
        created() {
            this.$parent.$on('add-medication', this.addMedication);
        }
    }
</script>
