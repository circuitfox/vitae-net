<template>
  <tr v-if="edit && isAdmin">
      <td>
        <form :action="route" :id="marEntry.id" method="POST">
          <input type="hidden" name="_token" :value="csrfToken">
          <input type="hidden" name="_method" value="PUT">
          <input type="hidden" name="id" :value="marEntry.id">
          <select class="form-control" name="medication_id" required>
            <option v-for="med in meds"
                    :value="med.id"
                    :selected="isCurrentMed(med.id)">{{ med.name }}</option>
          </select>
        </form>
      </td>
      <td>
        <div class="col-md-6">
          <input :form="marEntry.id" type="text" name="instructions" :value="marEntry.instructions" required>
        </div>
        <div class="col-md-6">
          <label class="control-label" for="stat">Stat/PRN:</label>
          <input :form="marEntry.id" type="checkbox" name="stat" value=1 v-model="stat" :checked="stat">
        </div>
      </td>
      <td v-for="(time, index) in marEntry.times">
        <input :form="marEntry.id" type="checkbox" :name="`given_at[${index}]`" value="1" :checked="isChecked(time)">
      </td>
      <td>
        <button :form="marEntry.id" class="col-md-12 btn btn-primary" type="submit">Submit</button>
      </td>
    </form>
  </tr>
  <tr v-else>
    <td>{{ marEntry.name }}</td>
    <td>{{ marEntry.instructions }}</td>
    <td v-for="time in marEntry.times" :class="isStat(time)"></td>
    <td v-if="isAdmin">
      <button class="btn btn-primary col-md-12" @click="setEdit">Edit</button>
    </td>
  </tr>
</template>

<script>
    export default {
        props: {
            meds: {
                type: Object,
                required: true,
            },
            marEntry: {
                type: Object,
                required: true
            },
            isAdmin: {
                type: Boolean,
                required: true
            },
            route: {
                type: String,
                required: true
            },
        },
        data: function() {
            return {
                csrfToken: window.Laravel.csrfToken,
                edit: false,
                stat: this.marEntry.stat,
            }
        },
        methods: {
            setEdit() {
                this.edit = true;
            },
            isStat(time) {
                return {
                    'stat': time || this.marEntry.stat,
                    'non-stat': !time && !this.marEntry.stat,
                }
            },
            isCurrentMed(id) {
                return this.marEntry.medId === id ? 'selected' : '';
            },
            isChecked(time) {
                return time ? 'checked' : '';
            },
        },
    }
</script>
