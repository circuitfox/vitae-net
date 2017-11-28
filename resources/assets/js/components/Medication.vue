<template>
  <div>
    <i class="pull-right glyphicon glyphicon-remove" @click="$emit('remove')"></i>
    <dl class='dl-horizontal'>
      <dt>Name:</dt>
      <dd>{{ item.name }}</dd>
      <dt>Dosage:</dt>
      <dd>{{ item.dosage }} {{ item.units }}</dd>
      <dt>Instructions:</dt>
      <dd>{{ item.instructions }}</dd>
      <dt>Comments:</dt>
      <dd>{{ item.comments }}</dd>
      <dt>Stat:</dt>
      <dd>{{ item.stat }}</dd>
    </dl>
    <hr>
    <div v-if="form">
      <input type="hidden" name="name" :value="item.name" :id="`med-name-${id}`">
      <input type="hidden" name="dosage" :value="item.dosage" :id="`med-dosage-${id}`">
      <input type="hidden" name="units" :value="item.units" :id="`med-units-${id}`">
      <input type="hidden" name="instructions" :value="item.instructions" :id="`med-instructions-${id}`">
      <input type="hidden" name="comments" :value="item.comments" :id="`med-comments-${id}`">
      <input type="hidden" name="stat" :value="item.stat" :id="`med-stat-${id}`">
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
