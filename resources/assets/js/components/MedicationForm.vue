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
        <input class="form-control" type="number" :name="`meds[${id}][dosage_amount]`" :value="item.dosage_amount" :id="`med-dosage-amount-${id}`" required>
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
      <label class="col-md-2 control-label" :for="`meds[${id}][instructions]`">Instructions:</label>
      <div class="col-md-6">
        <input class="form-control" type="text" :name="`meds[${id}][instructions]`" :id="`med-instructions-${id}`" :value="item.instructions" required>
        <span class="help-block" v-if="errors[`meds.${id}.instructions`]">
          {{ errors[`meds.${id}.instructions`][0] }}
        </span>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-2 control-label" :for="`meds[${id}][comments]`">Comments:</label>
      <div class="col-md-6">
        <textarea class="form-control" rows="3" :name="`meds[${id}][comments]`" :id="`med-comments-${id}`" :value="item.comments"></textarea>
        <span class="help-block" v-if="errors[`meds.${id}.comments`]">
          {{ errors[`meds.${id}.comments`][0] }}
        </span>
      </div>
    </div>
    <div class="form-group">
      <div class="checkbox col-md-offset-2 col-md-2">
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
