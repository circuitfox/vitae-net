<template>
  <div>
    <h3>Medication</h3>
    <hr>
    <medication v-for="(item, index) in items"
                :item="item"
                :id="index"
                :form="form"
                :key="index"
                @remove="removeMedication"></medication>
  </div>
</template>

<script>
    import Medication from './Medication.vue';

    export default {
        props: {
            form: {
                type: Boolean,
                default: false
            }
        },
        components: {
            'medication': Medication
        },
        data() {
            return {
                items: []
            }
        },
        methods: {
            addMedication(data) {
                this.items.push(data);
            },
            removeMedication(id) {
                this.items.splice(id, 1);
            }
        },
        created() {
            this.$parent.$on('add-medication', this.addMedication);
        }
    }
</script>
