<?php

namespace PHPFramework;

class Pagination
{

    protected int $countPages;
    protected int $currentPage;
    protected string $uri;

    public function __construct(
        protected int $totalRecords,
        protected int $perPage = PAGINATION_SETTINGS['perPage'],
        protected int $midSize = PAGINATION_SETTINGS['midSize'],
        protected int $maxPages = PAGINATION_SETTINGS['maxPages'],
        protected string $tpl = PAGINATION_SETTINGS['tpl'],
    )
    {
        $this->countPages = $this->getCountPages();
        $this->currentPage = $this->getCurrentPage();
        $this->uri = $this->getParams();
        $this->midSize = $this->getMidSize();
    }

    protected function getCountPages(): int
    {
        return (int)ceil($this->totalRecords / $this->perPage) ?: 1;
    }

    protected function getCurrentPage(): int
    {
        $page = (int)request()->get('page', 1);
        if ($page < 1 || $page > $this->countPages) {
            abort();
        }
        return $page;
    }

    protected function getParams()
    {
        $url = request()->uri;
        $url = parse_url($url);
        $uri = $url['path'];
        if (!empty($url['query']) && $url['query'] != '&') {
            parse_str($url['query'], $params);
            if (isset($params['page'])) {
                unset($params['page']);
            }
            if (!empty($params)) {
                $uri .= '?' . http_build_query($params);
            }
        }
        return $uri;
    }

    protected function getMidSize(): int
    {
        return ($this->countPages <= $this->maxPages) ? $this->countPages : $this->midSize;
    }

    public function getOffset(): int
    {
        return ($this->currentPage - 1) * $this->perPage;
    }

    public function getHtml()
    {
        $back = '';
        $forward = '';
        $first_page = '';
        $last_page = '';
        $pages_left = [];
        $pages_right = [];
        $current_page = $this->currentPage;

        if ($this->currentPage > 1) {
            $back = $this->getLink($this->currentPage - 1);
        }

        if ($this->currentPage < $this->countPages) {
            $forward = $this->getLink($this->currentPage + 1);
        }

        if ($this->currentPage > $this->midSize + 1) {
            $first_page = $this->getLink(1);
        }

        if ($this->currentPage < ($this->countPages - $this->midSize)) {
            $last_page = $this->getLink($this->countPages);
        }

        for ($i = $this->midSize; $i > 0; $i--) {
            if ($this->currentPage - $i > 0) {
                $pages_left[] = [
                    'link' => $this->getLink($this->currentPage - $i),
                    'number' => $this->currentPage - $i,
                ];
            }
        }

        for ($i = 1; $i <= $this->midSize; $i++) {
            if ($this->currentPage + $i <= $this->countPages) {
                $pages_right[] = [
                    'link' => $this->getLink($this->currentPage + $i),
                    'number' => $this->currentPage + $i,
                ];
            }
        }

        return view()->renderPartial($this->tpl, compact('back', 'forward', 'first_page', 'last_page', 'pages_left', 'pages_right', 'current_page'));
    }

    protected function getLink($page): string
    {
        if ($page == 1) {
            return rtrim($this->uri, '?&');
        }
        if (str_contains($this->uri, '&') || str_contains($this->uri, '?')) {
            return "{$this->uri}&page={$page}"; // users?status=1&page={$page}
        } else {
            return "{$this->uri}?page={$page}"; // users?page={$page}
        }
    }

    public function __toString(): string
    {
        return $this->getHtml();
    }

}