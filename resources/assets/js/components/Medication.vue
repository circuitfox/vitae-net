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
        <dd>{{ item.second_amount }} {{ item.second_unit }}</dd>
      </div>
      <div v-if="item.second_type === 'amount'">
        <dt>With:</dt>
        <dd>{{ item.second_amount }} {{ item.second_unit }}</dd>
      </div>
      <div v-if="item.second_type === 'in'">
        <dt>In:</dt>
        <dd>{{ item.secondary_name }}</dd>
        <dt>Amount:</dt>
        <dd>{{ item.second_amount }} {{ item.second_unit }}</dd>
      </div>
    </dl>
    <div v-if="form">
      <div class="row">
        <div class="form-group">
          <label class="col-md-3 control-label" :for="`medications[${id}][comments]`">Comments:</label>
          <div class="col-md-3">
            <textarea class="form-control" rows="3" :name="`medications[${id}][comments]`" :id="`med-comments-${id}`"></textarea>
          </div>
        </div>
      </div>
      <input type="hidden" :name="`medications[${id}][medication_id]`" :value="item.medication_id" :id="`med-id-${id}`">
      <input type="hidden" :name="`medications[${id}][name]`" :value="item.name" :id="`med-name-${id}`">
      <input type="hidden" :name="`medications[${id}][dosage_amount]`" :value="item.dosage_amount" :id="`med-dosage-amount-${id}`">
      <input type="hidden" :name="`medications[${id}][dosage_unit]`" :value="item.dosage_unit" :id="`med-dosage-unit-${id}`">
      <input type="hidden" :name="`medications[${id}][secondary_name]`" :value="item.secondary_name" :id="`med-secondary-name-${id}`">
      <input type="hidden" :name="`medications[${id}][second_amount]`" :value="item.second_amount" :id="`med-second-amount-${id}`">
      <input type="hidden" :name="`medications[${id}][second_unit]`" :value="item.second_unit" :id="`med-second-unit-${id}`">
      <input type="hidden" :name="`medications[${id}][second_type]`" :value="item.second_type" :id="`med-second-type-${id}`">
    </div>
    <hr>
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
