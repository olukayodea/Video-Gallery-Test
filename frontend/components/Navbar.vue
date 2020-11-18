<template>
<div>
  <b-navbar toggleable="lg" type="dark" variant="info">
    <b-navbar-brand href="#">AlgaeCal</b-navbar-brand>

    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

    <b-collapse id="nav-collapse" is-nav>

      <!-- Right aligned nav items -->
      <b-navbar-nav class="ml-auto">

        <b-navbar-nav right v-if="isAuthenticated">
            <b-nav-item href="#">{{ loggedInUser.username }}</b-nav-item>
            <b-nav-item href="#">Videos</b-nav-item>
            <b-nav-item href="#" @click="logout">Logout</b-nav-item>
        </b-navbar-nav>
        <b-navbar-nav right v-else>
            <b-nav-item href="#">Videos</b-nav-item>
        </b-navbar-nav>
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>
</div>
</template>
<script>
import { mapGetters } from 'vuex'

export default {
  computed: {
    ...mapGetters(['isAuthenticated', 'loggedInUser'])
  },
  methods: {
    async logout() {
      await this.$auth.logout();
    },
  },
}
</script>