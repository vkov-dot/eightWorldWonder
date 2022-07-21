<template>
    <div class="last-states issues-list col-lg-9 col-md-12   heading-show-list">
        <div>
            <div class="notes-list-div states-list">
                <div class="last-states-title">
                    <div class="last-states-title border-bottom-grey pb-1">
                        <router-link :to="{ name: 'headings.index' }">
                            {{ headingStates.name }}
                        </router-link>
                    </div>
                </div>
                    <states-list-element
                        v-for="state in headingStates.states?.data"
                        :key="state.id"
                        :state="state"
                        class="list-element"
                    />
            </div>
            <div v-if="user && user.admin">
                <button class="btn btn-danger" @click="deleteHeadingButton">
                    Видалити
                </button>
                <button class="btn btn-primary" @click="editHeadingButton">
                    Відредагувати
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import StatesListElement from "../list-elements/StatesListElement";
import IndexStatesList from "../StatesList";
import router from "../../router";

export default {
    name: "HeadingsShowPage",
    components: {
        IndexStatesList, StatesListElement
    },
    computed: {
        ...mapGetters('heading', ['headingStates']),
        ...mapGetters('auth', ['user']),

    },
    methods: {
        ...mapActions('heading', ['getStatesByHeadingId', 'deleteHeading', 'editHeading']),
        deleteHeadingButton() {
            this.deleteHeading(this.headingStates.id)
        },
        editHeadingButton() {
            let editHeadingRoute = {
                name: 'headings.edit',
                params: {
                    heading: this.headingStates.id
                } }
            router.push(editHeadingRoute)
        },

    },
    mounted() {
        this.getStatesByHeadingId(this.$route.params.heading);
    }
}
</script>
