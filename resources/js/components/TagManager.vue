<template>
  <div class="flex">
      <div class="w-1/2">
          <label class="font-bold">Locations</label>
          <ul id="tags">
              <li v-for="tag in locationTags" :key="tag.id">
                  <label :for="`tag-${tag.id}`" v-on:click="updateTags" :data-tag-id="tag.id">
                      <input type="checkbox"
                             :name="`tag-${tag.id}`"
                             :value="tag.id"
                             :disabled="loading"
                             :checked="activeTags.indexOf(tag.id) !== -1">
                      {{ tag.name }}
                  </label>
              </li>
          </ul>
      </div>
      <div class="w-1/2">
          <label class="font-bold">Topics</label>
          <ul id="tags">
              <li v-for="tag in topicTags" :key="tag.id">
                  <label :for="`tag-${tag.id}`" v-on:click="updateTags" :data-tag-id="tag.id">
                      <input type="checkbox"
                             :name="`tag-${tag.id}`"
                             :value="tag.id"
                             :disabled="loading"
                             :checked="activeTags.indexOf(tag.id) !== -1">
                      {{ tag.name }}
                  </label>
              </li>
          </ul>
      </div>
  </div>
</template>

<script>
export default {
    props: {
        updateEndpoint: { type: String, default: '' },
        locationTags: { type: Array, default: () => [] },
        topicTags: { type: Array, default: () => [] },
        currentTags: { type: Array, default: () => [] },
    },

    data: self => ({
        activeTags: self.currentTags,
        loading: false,
    }),

    methods: {
        updateTags(event) {
            this.loading = true;

            let tagId = parseInt(event.currentTarget.getAttribute('data-tag-id'));
            let oldTags = { ...this.activeTags };

            if (this.activeTags.indexOf(tagId) === -1) {
                this.addTag(tagId);
            } else {
                this.remTag(tagId);
            }

            axios.post(this.updateEndpoint, { tags: this.activeTags })
                .then(res => {
                    this.loading = false;
                    this.activeTags = res.data;
                })
                .catch(err => {
                    this.loading = false;
                    this.activeTags = oldTags;
                    console.log(err);
                });
        },

        addTag(tagId) {
            this.remTag(tagId); // To prevent duplicates.
            this.activeTags.push(tagId);
        },

        remTag(tagId) {
            this.activeTags = this.activeTags.filter(id => id !== tagId);
        },
    },
};
</script>
