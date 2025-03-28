<template>
    <a-tree class="draggable-tree" draggable block-node :tree-data="treeData"  @drop="onDrop" />
</template>

<script setup>
import { ref, watch, defineProps, defineEmits } from 'vue';

const props = defineProps({
    menuData: {
        type: Array,
        required: true
    }
});

const emit = defineEmits(['update:model-value']);

const buildTree = (items, parentId = null) => {
    return items
        .filter(item => item.id_danh_muc_cha === parentId)
        .map(item => ({
            title: item.ten_danh_muc,
            key: item.id,
            children: buildTree(items, item.id)
        }));
};

const treeData = ref(buildTree(props.menuData));

watch(
    () => props.menuData,
    (newData) => {
        treeData.value = buildTree(newData);
    },
    { deep: true }
);
const onDrop = (info) => {
    console.log("Drop:", info);

    const dropKey = info.node.key;
    const dragKey = info.dragNode.key;
    const dropPos = info.node.pos.split('-');
    const dropPosition = info.dropPosition - Number(dropPos[dropPos.length - 1]);

    const data = [...treeData.value];

    const loop = (data, key, callback) => {
        data.forEach((item, index, arr) => {
            if (item.key === key) {
                return callback(item, index, arr);
            }
            if (item.children) {
                loop(item.children, key, callback);
            }
        });
    };

    // Find drag object
    let dragObj;
    loop(data, dragKey, (item, index, arr) => {
        arr.splice(index, 1);
        dragObj = item;
    });

    if (!info.dropToGap) {
        // Drop on the content (inside the node)
        loop(data, dropKey, (item) => {
            item.children = item.children || [];
            item.children.push(dragObj);
        });
    } else if (
        (info.node.children || []).length > 0 && // has children
        info.node.expanded && // is expanded
        dropPosition === 1 // on the bottom gap
    ) {
        loop(data, dropKey, (item) => {
            item.children = item.children || [];
            item.children.unshift(dragObj);
        });
    } else {
        let ar;
        let i;
        loop(data, dropKey, (item, index, arr) => {
            ar = arr;
            i = index;
        });
        if (dropPosition === -1) {
            ar.splice(i, 0, dragObj);
        } else {
            ar.splice(i + 1, 0, dragObj);
        }
    }

    // Update the tree data with the modified structure
    treeData.value = data;
    emit('update:model-value', treeData.value);

};

</script>

<style scoped>
.draggable-tree {
    width: 100%;
    font-size: 16px;
}
</style>

