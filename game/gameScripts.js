async function gameNav(location) {
  const gameFrame = document.getElementById("gameFrame");
  await changeNavItemColor(location);
  gameFrame.src = "game/" + location + ".php";
}

async function changeNavItemColor(id) {
  const navItems = document
    .getElementById("gameNav")
    .getElementsByClassName("item");

  Array.prototype.forEach.call(navItems, function (item) {
    item.style = "color: rgb(96, 96, 96);";
  });

  const navItem = document.getElementById(id);
  navItem.style = "color: darkorange;";
}
