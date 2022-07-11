<template>
    <div>
        <div class="col-lg-12 last-states notes-list-div">
            <ul class="states-list">
                <states-list-element
                    v-for="state in states"
                    :key="state.id"
                    :state="state"
                    class="list-element"
                />
            </ul>
        </div>
        <!--
                <div class="row justify-content-center" v-if="states.length > states.total">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body pagination">
                                {{ states.links() }}
                            </div>
                        </div>
                    </div>
                </div>
        -->
    </div>
</template>

<script>
import StatesListElement from "./list-elements/StatesListElement";

export default {
    name: "IndexStatesList",
    components: {
        StatesListElement
    },
    props: {
        states: Array,
    }
}
</script>
