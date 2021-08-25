const client = 'ca-pub-3389773486006292';

export function insertAds() {
  window.adsbygoogle = window.adsbygoogle || [];
  let ads = [...document.querySelectorAll('[data-ads]')];
  ads.forEach((item) => {
    if (item.dataset.ads === 'article') {
      item.innerHTML = `<ins class="adsbygoogle"
      style="display:block; text-align:center;"
      data-ad-layout="in-article"
      data-ad-format="fluid"
      data-ad-client="${client}"
      data-ad-slot="8843408867"></ins>`;
    } else if (item.dataset.ads === 'footer') {
      item.innerHTML = `<ins class="adsbygoogle"
      style="display:block"
      data-ad-client="${client}"
      data-ad-slot="3190281066"
      data-ad-format="auto"
      data-full-width-responsive="true"></ins>`;
    }

    window.adsbygoogle.push({});
  });

  activateAds();
}

export function activateAds() {
  let script = document.createElement('script');
  document.body.appendChild(script);
  script.async = true;
  script.crossorigin = 'anonymous';
  script.src = `https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=${client}`;
}
