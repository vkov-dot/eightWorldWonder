<template>
    <div>
        <div v-if="this.allMedias.length">
            <index-media-list :medias="this.allMedias"/>
        </div>
    </div>
</template>

<script>

import IndexMediaList from '../IndexMediaList'
import {mapActions, mapGetters} from 'vuex'

export default {
    name: "MediaIndexPage",
    components: {
        IndexMediaList,
    },
    computed: mapGetters(['allMedias']),
    methods: {
        ...mapActions(['getAllMedias']),
    },
    mounted() {
        this.getAllMedias();
    }
}
</script>

<style scoped>

</style>
