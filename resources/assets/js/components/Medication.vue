<template>
  <div>
    <i class="pull-right glyphicon glyphicon-remove" @click="$emit('remove', this.id)"></i>
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
  </div>
</template>

<script>
    export default {
        props: ['item', 'id']
    }
</script>
