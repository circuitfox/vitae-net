<template>
  <div>
    <i class="pull-right glyphicon glyphicon-remove" @click="$emit('remove')"></i>
    <dl class='dl-horizontal'>
      <dt>Name:</dt>
      <dd>{{ item.name }}</dd>
      <dt>Dosage:</dt>
      <dd>{{ item.dosage_amount }} {{ item.dosage_unit }}</dd>
      <dt>Comments:</dt>
      <dd>{{ item.comments }}</dd>
    </dl>
    <hr>
    <div v-if="form">
      <input type="hidden" name="name" :value="item.name" :id="`med-name-${id}`">
      <input type="hidden" name="dosage_amount" :value="item.dosage_amount" :id="`med-dosage-amount-${id}`">
      <input type="hidden" name="dosage_unit" :value="item.dosage_unit" :id="`med-dosage-unit-${id}`">
      <input type="hidden" name="comments" :value="item.comments" :id="`med-comments-${id}`">
    </div>
  </div>
</template>

<script>
    export default {
        props: {
            item: {
                type: Object,
                required: true,
            },
            id: {
                type: Number,
                required: true,
            },
            form: {
                type: Boolean,
                default: false,
            }
        }
    }
</script>
