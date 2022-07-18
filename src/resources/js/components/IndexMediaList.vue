<template>
    <div class="col-lg-12 last-states notes-list-div">
        <ul class="states-list">
            <div class="last-states-title border-bottom-grey">
                <p>
                    Наші медіа
                </p>
            </div>
            <media-list-element
                v-for="media in medias"
                :key="media.id"
                :media="media"
                class="list-element"
            />
        </ul>
    </div>
</template>

<script>
import MediaListElement from "./list-elements/MediaListElement";

export default {
    name: "IndexMediaList",
    components: {
        MediaListElement
    },
    props: {
        medias: Array,
    }
}
</script>
