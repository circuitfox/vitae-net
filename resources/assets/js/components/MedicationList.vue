<template>
  <div id="medication-list" v-if="items.length <= 0">
  </div>
  <div id="medication-list" v-else>
    <h3>Medication</h3>
    <hr>
    <medication v-for="(item, index) in items"
                :item="item"
                :id="index"
                :form="form"
                :key="index"
                @remove="items.splice(index, 1)"></medication>
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
        },
        created() {
            this.$parent.$on('add-medication', this.addMedication);
        }
    }
</script>
