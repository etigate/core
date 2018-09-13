/*
 * This file is part of Glugox.
 *
 * (c) Glugox <glugox@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

var navbar_data = [
  {
    "text": "Link 1",
    "url": "#"
  },
  {
    "text": "Link 2",
    "url": "#"
  },
  {
    "text": "Link 3",
    "url": "#",
    "submenu": [
      {
        "text": "Sublink 1",
        "url": "#",
        "submenu": [
          {
            "text": "SubSublink 1",
            "url": "#"
          }
        ]
      },
      {
        "text": "Sublink 2",
        "url":"#",
        "submenu": [
          {
            "text": "SubSublink 2",
            "url": "#"
          }
        ]
      }
    ]
  }
]