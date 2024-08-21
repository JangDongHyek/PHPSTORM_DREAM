<html>
<head>
<title>쿠폰사서함</title>
</head>
<script language="javascript">
opener.UseCoupon("<?= $_PID ?>","<?= $cpntype ?>","<?= $rate ?>");
self.close();
</script>
</html>