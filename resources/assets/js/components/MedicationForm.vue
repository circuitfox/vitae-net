<template>
  <div>
    <i class="pull-right glyphicon glyphicon-remove" @click="$emit('remove')"></i>
    <div class="form-group">
      <label class="col-md-2 control-label" :for="`meds[${id}][name]`">Name:</label>
      <div class="col-md-6">
        <input class="form-control" type="text" :name="`meds[${id}][name]`" :value="item.name" :id="`med-name-${id}`" required>
        <span class="help-block" v-if="errors[`meds.${id}.name`]">
          {{ errors[`meds.${id}.name`][0] }}
        </span>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-2 control-label" :for="`meds[${id}][dosage_amount]`">Dosage:</label>
      <div class="col-md-3">
        <input class="form-control" type="number" :name="`meds[${id}][dosage_amount]`" min="0" step="0.01" :value="item.dosage_amount" :id="`med-dosage-amount-${id}`" required>
        <span class="help-block" v-if="errors[`meds.${id}.dosage_amount`]">
          {{ errors[`meds.${id}.dosage_amount`][0] }}
        </span>
      </div>
      <div class="col-md-3">
        <input class="form-control" type="text" :name="`meds[${id}][dosage_unit]`" :value="item.dosage_unit" :id="`med-dosage-unit-${id}`" required>
        <span class="help-block" v-if="errors[`meds.${id}.dosage_unit`]">
          {{ errors[`meds.${id}.dosage_unit`][0] }}
        </span>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-2 control-label" :for="`meds[${id}][second_type]`"
             data-toggle="tooltip" data-placement="right" title="
Some medications contain extra infromation besides just their name and dosage.
These can be divided into three types:

'and' - There is a secondary drug with its own name and dosage

'with' - There is a separate quantity e.g. 10mL with 100 units/mL

'in' - The medication is in some medium, such as 10mL saline

If none of these conditions apply, leave these fields blank.">
        Second Type:
      </label>
      <div class="col-md-6">
        <select :id="`med-second-type-${id}`" class="form-control" :name="`meds[${id}][second_type]`" form="medication-form">
          <option value="" selected>none</option>
          <option value="combo">and</option>
          <option value="amount">with</option>
          <option value="in">in</option>
        </select>
        <span class="help-block" v-if="errors[`meds.${id}.second_type`]">
          {{ errors[`meds.${id}.second_type`][0] }}
        </span>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-2 control-label" :for="`meds[${id}][secondary_name]`">Name:</label>
      <div class="col-md-6">
        <input class="form-control" type="text" :name="`meds[${id}][secondary_name]`" :value="item.secondary_name" :id="`med-secondary-name-${id}`">
        <span class="help-block" v-if="errors[`meds.${id}.secondary_name`]">
          {{ errors[`meds.${id}.secondary_name`][0] }}
        </span>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-2 control-label" :for="`meds[${id}][second_amount]`">Amount:</label>
      <div class="col-md-3">
        <input class="form-control" type="number" :name="`meds[${id}][second_amount]`" min="0" step="0.01" :value="item.second_amount" :id="`med-second-amount-${id}`">
        <span class="help-block" v-if="errors[`meds.${id}.second_amount`]">
          {{ errors[`meds.${id}.second_amount`][0] }}
        </span>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-2 control-label" :for="`meds[${id}][second_unit]`">Unit:</label>
      <div class="col-md-3">
        <input class="form-control" type="text" :name="`meds[${id}][second_unit]`" :value="item.second_unit" :id="`med-second-unit-${id}`">
        <span class="help-block" v-if="errors[`meds.${id}.second_unit`]">
          {{ errors[`meds.${id}.second_unit`][0] }}
        </span>
      </div>
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
            errors: {
                type: Object,
                default: {},
            },
        }
    }
</script>
