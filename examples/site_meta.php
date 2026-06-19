<?php
/**
 * 站点元信息示例 - 基于数组的简单描述生成器
 */

// 核心站点元数据
$siteMeta = [
    'site_name' => 'HomeApp HTH',
    'home_url' => 'https://homeapp-hth.com.cn',
    'keywords' => ['华体会', '运动生活', '健康社区', '活动平台'],
    'description_fallback' => '华体会 - 您的运动生活伙伴，汇聚最新活动与社区动态。',
    'language' => 'zh-CN',
    'author' => 'HomeApp Team',
    'version' => '1.2.0',
    'created' => '2024-03-10',
    'updated' => '2025-02-18'
];

// 扩展页面元信息（示例数据）
$pageMeta = [
    'home' => [
        'title' => '首页 - 华体会',
        'desc' => '欢迎来到华体会，探索精彩运动生活与社区活动。',
        'og_image' => '/images/home-og.jpg'
    ],
    'about' => [
        'title' => '关于我们 - 华体会',
        'desc' => '华体会致力于打造健康、活力的运动社交平台，连接每一位热爱生活的人。',
        'og_image' => '/images/about-og.jpg'
    ],
    'events' => [
        'title' => '活动中心 - 华体会',
        'desc' => '查看近期热门运动活动与社区聚会，华体会带您体验无限精彩。',
        'og_image' => '/images/events-og.jpg'
    ]
];

/**
 * 生成指定页面的简短描述文本
 *
 * @param string $pageKey 页面标识符，如 'home', 'about', 'events'
 * @param bool $useFallback 当找不到页面时是否使用默认描述
 * @return string 生成的描述文本
 */
function generateDescription(string $pageKey, bool $useFallback = true): string
{
    global $siteMeta, $pageMeta;

    if (isset($pageMeta[$pageKey])) {
        $page = $pageMeta[$pageKey];
        $desc = $page['desc'];
        // 如果描述结尾没有句号则添加
        if (substr($desc, -1) !== '。' && substr($desc, -1) !== '.') {
            $desc .= '。';
        }
        // 追加站点标识
        $desc .= ' 了解更多请访问 ' . $siteMeta['home_url'];
        return $desc;
    }

    if ($useFallback) {
        return $siteMeta['description_fallback'] . ' 官方网址：' . $siteMeta['home_url'];
    }

    return '';
}

/**
 * 生成完整标题（页面标题 + 站点名称）
 *
 * @param string $pageKey 页面标识符
 * @return string 完整标题，已做HTML转义
 */
function generateTitle(string $pageKey): string
{
    global $pageMeta;

    if (isset($pageMeta[$pageKey])) {
        $title = $pageMeta[$pageKey]['title'];
    } else {
        $title = '华体会 - 您的运动生活伙伴';
    }

    return htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
}

/**
 * 获取站点元数据数组
 *
 * @return array 站点元数据
 */
function getSiteMeta(): array
{
    global $siteMeta;
    return $siteMeta;
}

/**
 * 获取所有可用的页面键列表
 *
 * @return array 页面键列表
 */
function getAvailablePages(): array
{
    global $pageMeta;
    return array_keys($pageMeta);
}

// 示例用法（可直接运行）
$examplePage = 'events';
echo '标题: ' . generateTitle($examplePage) . "\n";
echo '描述: ' . generateDescription($examplePage) . "\n";

$secondPage = 'about';
echo "\n标题: " . generateTitle($secondPage) . "\n";
echo '描述: ' . generateDescription($secondPage) . "\n";

// 测试不存在的页面
$unknownPage = 'contact';
echo "\n未知页面描述（使用备用）: " . generateDescription($unknownPage, true) . "\n";
echo "未知页面描述（不使用备用）: '" . generateDescription($unknownPage, false) . "'\n";

// 列出所有可用页面
echo "\n可用页面: " . implode(', ', getAvailablePages()) . "\n";

// 打印站点核心信息
$meta = getSiteMeta();
echo "\n站点名称: " . $meta['site_name'] . "\n";
echo "关键词: " . implode(', ', $meta['keywords']) . "\n";
echo "版本: " . $meta['version'] . "\n";
?>