<template>
  <div>
    <i class="pull-right glyphicon glyphicon-remove" @click="$emit('remove')"></i>
    <div class="form-group">
      <input type="hidden" :name="`mars[${id}][medical_record_number]`" :value="mrn">

      <select class="form-control" :name="`mars[${id}][medication_id]`" :id="`mars-med`">
        <option value=0> Choose medication </option>
        <option v-for="(med in meds" :value="med.id"> {{ med.name }} </option>
      </select>
      <span class="help-block" v-if="errors[`mars.${id}.medication_id`]">
        <strong>{{errors[`mars.${id}.medication_id`][0] }}</strong>
      </span>

      <label class="control-label" :for="`mars[${id}][instructions]`">Instructions:</label>
      <input type="text" class="form-control" :name="`mars[${id}][instructions]`" :value="item.instructions" :id="`mars-instructions-${id}`" required>
      <span class="help-block" v-if="errors[`mars.${id}.instructions`]">
        <strong>{{ errors[`mars.${id}.instructions`] }}</strong>
      </span>

      <label class="form-check-label checkbox-label-above" :for="`mars[${id}][stat]`">
        <input class="form-check-input" type="checkbox" :name="`mars[${id}][stat]`" id="`mars-stat-${id}`" value=1>STAT/PRN?
      </label>
    </div>
    <div class="form-group">
      <label class="control-label" style="padding: 10px;" :for="`mars[${id}][given_at][0]`">Administration Times:</label>
      <label class="form-check-label checkbox-label-above">
        <input class="form-check-input" type="checkbox" :name="`mars[${id}][given_at][0]`" value=1>0700
      </label>

      <label class="form-check-label checkbox-label-above">
        <input class="form-check-input" type="checkbox" :name="`mars[${id}][given_at][1]`" value=1>0800
      </label>

      <label class="form-check-label checkbox-label-above">
        <input class="form-check-input" type="checkbox" :name="`mars[${id}][given_at][2]`" value=1>0900
      </label>

      <label class="form-check-label checkbox-label-above">
        <input class="form-check-input" type="checkbox" :name="`mars[${id}][given_at][3]`" value=1>1000
      </label>

      <label class="form-check-label checkbox-label-above">
        <input class="form-check-input" type="checkbox" :name="`mars[${id}][given_at][4]`" value=1>1100
      </label>

      <label class="form-check-label checkbox-label-above">
        <input class="form-check-input" type="checkbox" :name="`mars[${id}][given_at][5]`" value=1>1200
      </label>

      <label class="form-check-label checkbox-label-above">
        <input class="form-check-input" type="checkbox" :name="`mars[${id}][given_at][6]`" value=1>1300
      </label>

      <label class="form-check-label checkbox-label-above">
        <input class="form-check-input" type="checkbox" :name="`mars[${id}][given_at][7]`" value=1>1400
      </label>

      <label class="form-check-label checkbox-label-above">
        <input class="form-check-input" type="checkbox" :name="`mars[${id}][given_at][8]`" value=1>1500
      </label>

      <label class="form-check-label checkbox-label-above">
        <input class="form-check-input" type="checkbox" :name="`mars[${id}][given_at][9]`" value=1>1600
      </label>

      <label class="form-check-label checkbox-label-above">
        <input class="form-check-input" type="checkbox" :name="`mars[${id}][given_at][10]`" value=1>1700
      </label>

      <label class="form-check-label checkbox-label-above">
        <input class="form-check-input" type="checkbox" :name="`mars[${id}][given_at][11]`" value=1>1800
      </label>

      <label class="form-check-label checkbox-label-above">
        <input class="form-check-input" type="checkbox" :name="`mars[${id}][given_at][12]`" value=1>1900
      </label>
    </div>
  </div>
</template>

<script>
    export default {
        props: {
            mrn: {
              type: Number,
            },
            meds: {
              type: Object,
            },
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
        },
    }
</script>

<style scoped>
.checkbox-label-above {
  position: relative;
  display: inline-block;
  vertical-align: middle;
  padding: 0 5px;
  text-align: center;
}

.checkbox-label-above input {
  position: absolute;
  top: 15px;
  left: 50%;
  margin-left: -6px;
  display: block;
  cursor: pointer;
}
</style>
