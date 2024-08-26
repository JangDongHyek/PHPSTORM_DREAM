const express = require("express");
const router = express.Router();
const { v4: uuidV4 } = require("uuid");
router.get("/", async (req, res) => {
  res.redirect(`/${uuidV4()}`);
});
router.get("/:room", (req, res) => {
  res.render("room", { roomId: req.params.room,users:req.query.users });
});
module.exports = router;
