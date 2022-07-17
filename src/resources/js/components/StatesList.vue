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
