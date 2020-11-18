<template>
    <b-form>
        <p v-if="formError" class="error">
            {{ formError }}
        </p>
        <b-form-group
        id="input-username"
        label="Username:"
        label-for="username"
        >
        <b-form-input
            id="username"
            v-model="username"
            type="text"
            required
            placeholder="Enter Username"
            @keypress="checkForm"
            @change="checkForm"
        ></b-form-input>
        </b-form-group>
        <b-button type="button" @click="onSubmit" :disabled="disabled" class="button--green">Submit</b-button>
    </b-form>
</template>

<script>
export default {
  data() {
    return {
        formError: null,
        username: '',
        disabled: true
    };
  },
  methods: {
    async checkForm(e) {
      this.formError = "";

      if (this.username.length < 3) {
        this.formError = "Minimum of 3 characters is allowed"
        this.disabled = true;
      } else {
        this.disabled = false;
      }
    },
    async onSubmit(evt){
      evt.preventDefault();
      console.log('A form was submitted');
      try {
        let data = {
          username: this.username
        }

        let res = await this.$axios.post("users/login", data)
        console.log(res.data);
        this.$auth.setUser(res.data.data);
        this.$router.push('/videos')
      } catch (e) {
        console.log(e)
        if(e.response && e.response.status == 404){
          this.formError = "Sorry, that username is not found"
        } else {
          this.formError = "Sorry, an error has occured"
        }
      }
      
    }
  }
}
</script>
