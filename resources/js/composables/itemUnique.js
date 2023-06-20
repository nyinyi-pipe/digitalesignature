export default function itemUnique(items, type = "name") {
    let unique_items = [];
    items.forEach((item) => {
        if (
            !unique_items.includes(
                type == "email" ? item.recipient.email : item.recipient.name
            )
        ) {
            unique_items.push(
                type == "email" ? item.recipient.email : item.recipient.name
            );
        }
    });
    return unique_items;
}
