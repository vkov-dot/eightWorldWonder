<template>
    <div class="row list">
        <div class="col-12 heading-list">
            <ul class="row heading-list-head col-12">
                <router-link
                    :to="{ name: 'headings.show', params: {heading: heading.id} }"
                    class="col-xl-3 col-lg-4 col-sm-6 col-12 heading-list-elem"
                    v-for="heading in this.allHeadings"
                    :key="heading.id">
                    <div class="heading-image">
                        <p>
                            <img :src="`storage/${heading.image}`" alt="аватар">
                        </p>
                    </div>
                    <p class="heading-name">
                        {{ heading.name }}
                    </p>
                </router-link>
            </ul>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";

export default {
    name: "HeadingsIndexPage",
    computed: mapGetters('heading', ['allHeadings']),
    methods: {
        ...mapActions('heading', ['getAllHeadings']),
    },
    mounted() {
        this.getAllHeadings();
    }
}
</script>
