<template>
  <div>
    <i class="pull-right glyphicon glyphicon-remove" @click="$emit('remove')"></i>
    <dl class="dl-horizontal dl-wrap">
      <dt>Name:</dt>
      <dd>{{ item.name }}</dd>
      <dt>Dosage:</dt>
      <dd>{{ item.dosage_amount }} {{ item.dosage_unit }}</dd>
      <div v-if="item.second_type === 'combo'">
        <dt>Second Medication Name:</dt>
        <dd>{{ item.secondary_name }}</dd>
        <dt>Dosage:</dt>
        <dd>{{ item.dosage_amount }} {{ item.dosage_unit }}</dd>
      </div>
      <div v-if="item.second_type === 'amount'">
        <dt>With:</dt>
        <dd>{{ item.dosage_amount }} {{ item.dosage_unit }}</dd>
      </div>
      <div v-if="item.second_type === 'in'">
        <dt>In:</dt>
        <dd>{{ item.secondary_name }}</dd>
        <dt>Amount:</dt>
        <dd>{{ item.dosage_amount }} {{ item.dosage_unit }}</dd>
      </div>
      <dt>Comments:</dt>
      <dd>{{ item.comments }}</dd>
    </dl>
    <hr>
    <div v-if="form">
      <input type="hidden" name="name" :value="item.name" :id="`med-name-${id}`">
      <input type="hidden" name="dosage_amount" :value="item.dosage_amount" :id="`med-dosage-amount-${id}`">
      <input type="hidden" name="dosage_unit" :value="item.dosage_unit" :id="`med-dosage-unit-${id}`">
      <input type="hidden" name="secondary_name" :value="item.secondary_name" :id="`med-secondary-name-${id}`">
      <input type="hidden" name="second_amount" :value="item.second_amount" :id="`med-second-amount-${id}`">
      <input type="hidden" name="second_unit" :value="item.second_type" :id="`med-second-type-${id}`">
      <input type="hidden" name="second_type" :value="item.second_type" :id="`med-second-type-${id}`">
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
