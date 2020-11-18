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
        ></b-form-input>
        </b-form-group>
        <b-button type="button" @click="onSubmit" class="button--green">Submit</b-button>
    </b-form>
</template>