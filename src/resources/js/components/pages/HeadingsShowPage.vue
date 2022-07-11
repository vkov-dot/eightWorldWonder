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
                        v-for="state in headingStates.states.data"
                        :key="state.id"
                        :state="state"
                        class="list-element"
                    />
            </div>
<!--            @if(Auth::user() && Auth::user()->admin)
            <form action="{{ route('headings.edit', ['heading' => $heading->id]) }}"
                  class="">
                @csrf
                <button type="submit" class="btn btn-primary">Редагувати</button>
            </form>-->
<!--            @endif
            @if($heading->states->total() > $heading->states->count())
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body pagination">
                            {{ $states->links() }}
                        </div>
                    </div>
                </div>
            </div>
            @endif-->
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import StatesListElement from "../list-elements/StatesListElement";
import IndexStatesList from "../StatesList";

export default {
    name: "HeadingsShowPage",
    components: {IndexStatesList, StatesListElement},
    computed: mapGetters(['headingStates']),
    methods: {
        ...mapActions(['getStatesByHeadingId']),
    },
    mounted() {
        console.log(this.headingStates);
        this.getStatesByHeadingId(this.$route.params.heading);
    }
}
</script>

<style scoped>

</style>
