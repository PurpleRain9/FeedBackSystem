 // Confetti - modified from: https://github.com/daniel-lundin/dom-confetti
        var defaultColors = ['#fffa65','#2ecc71','#bdc3c7','#e74c3c'];
        
        function createElements(root, elementCount, colors, width, height) {
          return Array.from({
            length: elementCount,
          }).map(function(_, index) {
            var element = document.createElement('div');
            var color = colors[index % colors.length];
            element.style['background-color'] = color; // eslint-disable-line space-infix-ops
        
            element.style.width = width;
            element.style.height = height;
            element.style.position = 'absolute';
            element.style.willChange = 'transform, opacity';
            element.style.visibility = 'hidden';
            root.appendChild(element);
            return element;
          });
        }
        
        function randomPhysics(angle, spread, startVelocity, random) {
          var radAngle = angle * (Math.PI / 180);
          var radSpread = spread * (Math.PI / 180);
          return {
            x: 0,
            y: 0,
            z: 0,
            wobble: random() * 10,
            wobbleSpeed: 0.1 + random() * 0.1,
            velocity: startVelocity * 0.5 + random() * startVelocity,
            angle2D: -radAngle + (0.5 * radSpread - random() * radSpread),
            angle3D: -(Math.PI / 4) + random() * (Math.PI / 2),
            tiltAngle: random() * Math.PI,
            tiltAngleSpeed: 0.1 + random() * 0.3,
          };
        }
        
        function updateFetti(fetti, progress, dragFriction, decay) {
          /* eslint-disable no-param-reassign */
          fetti.physics.x += Math.cos(fetti.physics.angle2D) * fetti.physics.velocity;
          fetti.physics.y += Math.sin(fetti.physics.angle2D) * fetti.physics.velocity;
          fetti.physics.z += Math.sin(fetti.physics.angle3D) * fetti.physics.velocity;
          fetti.physics.wobble += fetti.physics.wobbleSpeed; // Backward compatibility
        
          if (decay) {
            fetti.physics.velocity *= decay;
          } else {
            fetti.physics.velocity -= fetti.physics.velocity * dragFriction;
          }
        
          fetti.physics.y += 3;
          fetti.physics.tiltAngle += fetti.physics.tiltAngleSpeed;
          var _fetti$physics = fetti.physics;
          var x = _fetti$physics.x;
          var y = _fetti$physics.y;
          var z = _fetti$physics.z;
          var tiltAngle = _fetti$physics.tiltAngle;
          var wobble = _fetti$physics.wobble;
        
          var wobbleX = x + 10 * Math.cos(wobble);
          var wobbleY = y + 10 * Math.sin(wobble);
          var transform =
            'translate3d(' +
            wobbleX +
            'px, ' +
            wobbleY +
            'px, ' +
            z +
            'px) rotate3d(1, 1, 1, ' +
            tiltAngle +
            'rad)';
          fetti.element.style.visibility = 'visible';
          fetti.element.style.transform = transform;
          fetti.element.style.opacity = 1 - progress;
          /* eslint-enable */
        }
        
        function animate(root, fettis, dragFriction, decay, duration, stagger) {
          var startTime = void 0;
          return new Promise(function(resolve) {
            function update(time) {
              if (!startTime) startTime = time;
              var elapsed = time - startTime;
              var progress = startTime === time ? 0 : (time - startTime) / duration;
              fettis.slice(0, Math.ceil(elapsed / stagger)).forEach(function(fetti) {
                updateFetti(fetti, progress, dragFriction, decay);
              });
        
              if (time - startTime < duration) {
                requestAnimationFrame(update);
              } else {
                fettis.forEach(function(fetti) {
                  if (fetti.element.parentNode === root) {
                    return root.removeChild(fetti.element);
                  }
                });
                resolve();
              }
            }
        
            requestAnimationFrame(update);
          });
        }
        
        var defaults = {
          angle: 90,
          spread: 45,
          startVelocity: 45,
          elementCount: 50,
          width: '10px',
          height: '10px',
          perspective: '',
          colors: defaultColors,
          duration: 3000,
          stagger: 0,
          dragFriction: 0.1,
          random: Math.random,
        };
        
        function backwardPatch(config) {
          if (!config.stagger && config.delay) {
            config.stagger = config.delay;
          }
        
          return config;
        }
        
        window.confetti = function(root) {
          var config = arguments.length <= 1 || arguments[1] === undefined ? {} : arguments[1];
        
          var _Object$assign = Object.assign({}, defaults, backwardPatch(config));
        
          var elementCount = _Object$assign.elementCount;
          var colors = _Object$assign.colors;
          var width = _Object$assign.width;
          var height = _Object$assign.height;
          var perspective = _Object$assign.perspective;
          var angle = _Object$assign.angle;
          var spread = _Object$assign.spread;
          var startVelocity = _Object$assign.startVelocity;
          var decay = _Object$assign.decay;
          var dragFriction = _Object$assign.dragFriction;
          var duration = _Object$assign.duration;
          var stagger = _Object$assign.stagger;
          var random = _Object$assign.random;
        
          root.style.perspective = perspective;
          var elements = createElements(root, elementCount, colors, width, height);
          var fettis = elements.map(function(element) {
            return {
              element: element,
              physics: randomPhysics(angle, spread, startVelocity, random),
            };
          });
          return animate(root, fettis, dragFriction, decay, duration, stagger);
        };
        
        
        function badConfetti(e) {
                // Burst of celebratory confetti!
                window.confetti(
                  document.getElementById('badBtn'), 
                  { angle: 90, spread: 180, startVelocity: 40, elementCount: 50, decay: 0.7 }
                );
            } 
        
       