(defun get-events (args) (with-open-file (...)))
(defun get-effects (args) (with-open-file (...)))
(defun get-coords (date, graph-start, scale, geo-coords)
    (let ((co (list (/ (- date graph-start) scale) 0)))
	   	;convert geo-coords -> single number with multidimensional scaling
        co))
(defun get-link (event)
	“mail.google.com”) ;deal with once essay database implemented
(defun get-name (event)
    'Hithere)
(defun points-svg (events)
    (loop for ev in events collecting
        (format nil "<g r=\"5\" stroke=\"black\" stroke-width=\"1\">
            <text visibility=\"hidden\">~a</text>
            <circle cx=\"~d\" cy=\"~d\" fill=\"~a\" id=\"~a\" />
            <set attributeName=\"visibility\" from=\"hidden\" to=\"visible\" begin=\"~a.mouseover\" />
            </g>" (get-name ev) (car (get-coords ... ev)) (cadr (get-coords ... ev))
            (get-color ev) ;based on type of event?
            (get-name ev) (get-name ev))))
(defun make-graph (events effects)
    (let ((gr (format nil "<g r="5" stroke="black" stroke-width="3">~{~a~%~}</g>
