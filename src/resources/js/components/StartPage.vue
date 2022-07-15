<template>
    <div class="row start-section">
        <div class="col-lg-5 col-md-12 last-states">
            <last-states-list :states="this.lastStates"/>
            <last-issues-list :issues="this.lastIssues"/>
        </div>
            <carousel :states="this.lastStates"/>
    </div>

</template>

<script>
import LastStatesList from "./LastStatesList";
import LastIssuesList from "./LastIssuesList";
import { mapActions, mapGetters } from "vuex"
import Carousel from "./Carousel";

export default {
    name: "StartPage",
    components: {
        Carousel,
        LastIssuesList,
        LastStatesList,
    },
    computed: mapGetters(['lastStates', 'lastIssues']),
    methods: {
        ...mapActions(['getLastIssues', 'getLastStates']),
        ToStateShowPage(id) {
            this.$router.push({ name: 'states.show', state: id })
        }
    },
    mounted() {
        this.getLastIssues();
        this.getLastStates();
    }
}
</script>
