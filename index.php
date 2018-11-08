<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <script src="common/js/jquery-1.10.2.min.js"></script>
    <!-- 引入 ECharts 文件 -->
    <script src="common/js/echarts.js"></script>
</head>
<body>
<!-- 为 ECharts 准备一个具备大小（宽高）的 DOM -->
<?php for($i=1;$i < 298;$i+=1){ ?>
    <div id="main<?php echo $i; ?>" style="width: 600px;height:400px;"></div>
<?php } ?>

<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    // http://echarts.baidu.com/examples/data/asset/data/flare.json
    // 基于准备好的dom，初始化echarts实例
    var url = "mydata.php";
    $.get(url, function (rst) {
        console.log(typeof(rst));
        var data = $.parseJSON(rst);   // json字符串转数组
        var myChart=[];
        for (var i = 1; i <=298; i++) {
            var datanew = data[i-1];
            console.log(datanew);
            var key = "main"+i;
            myChart[i] = echarts.init(document.getElementById(key));
            myChart[i].setOption(option = {
                tooltip: {
                    trigger: 'item',
                    triggerOn: 'mousemove'
                },
                series: [
                    {
                        initialTreeDepth:4,
                        type: 'tree',
                        data: [datanew],
                        left: '2%',
                        right: '2%',
                        top: '8%',
                        bottom: '20%',
                        symbol: 'emptyCircle',
                        orient: 'vertical',
                        expandAndCollapse: true,
                        label: {
                            normal: {
                                position: 'top',
                                rotate: -90,
                                verticalAlign: 'middle',
                                align: 'right',
                                fontSize: 9
                            }
                        },
                        leaves: {
                            label: {
                                normal: {
                                    position: 'bottom',
                                    rotate: -90,
                                    verticalAlign: 'middle',
                                    align: 'left'
                                }
                            }
                        },
                        animationDurationUpdate: 750
                    }
                ]
            });

        }
    });


</script>
</body>
</html>